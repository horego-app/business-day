# frozen_string_literal: true

module BusinessDay
  class Officer
    HOLIDAYS = YAML.load_file(File.dirname(__FILE__) + '/holiday.yml')['dates']

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
      HOLIDAYS.include?(@date.to_date.to_s)
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
