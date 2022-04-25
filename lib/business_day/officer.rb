# frozen_string_literal: true

module BusinessDay
  class Officer
    CONFIG_URL = 'https://prts-gutenberg.s3.ap-southeast-1.amazonaws.com/friday/holiday.yml'

    def initialize(date, increment = 1)
      @date      = normalize_date(date)
      @increment = increment.to_i
      @operator  = @increment >= 0 ? '+' : '-'
    end

    def perform(iteration = 0)
      return @date if iteration >= 1825 # 5 years
      return @date unless iteration_valid?(iteration)

      @date = @date.send(@operator, 1.day)

      if holiday? || weekend?
        perform(iteration)
      else
        perform(iteration + 1)
      end
    end

    def holidays
      @holidays ||= begin
        content = URI.open(CONFIG_URL) { |f| f.read }
        YAML::load(content)['dates']
      rescue StandardError => e
        []
      end
    end

    def holiday_checking
      holiday?
    end
    alias calculate perform

    private

    def normalize_date(date)
      date = Time.zone.parse(date) if date.is_a?(String)

      date
    end

    def holiday?
      holidays.include?(@date.to_date.to_s)
    end

    def weekend?
      [0, 6].include?(@date.wday)
    end

    def iteration_valid?(iteration)
      if @increment >= 0
        @increment.abs > iteration
      else
        iteration < @increment.abs
      end
    end
  end
end
