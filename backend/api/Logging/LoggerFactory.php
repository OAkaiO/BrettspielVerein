<?php

namespace BVZ\Logging;

use BVZ\Env;
use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\NoopHandler;
use Monolog\Processor\ProcessorInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\TestHandler;
use Monolog\Level;
use Monolog\Logger;
use Monolog\LogRecord;
use ReflectionEnum;

require_once __DIR__ . "/../../vendor/autoload.php";

class LoggerFactory
{
    public function __construct(private readonly bool $testing = false)
    {}

    public function getLogger(string $loggerName): Logger
    {
        $log = new Logger($loggerName);
        if (ENV::get(Env::LOG_LEVEL) === 'Off')
        {
            $log->pushHandler(new NoopHandler());
            return$log;
        }
        elseif ($this->testing)
        {
            $log->pushHandler(new TestHandler());
            return $log;
        }

        $handler = new StreamHandler(Env::getLogPath(), $this->getLogLevel());
        $handler->setFormatter($this->getFormatter());
        $log->pushHandler($handler);
        $log->pushProcessor($this->getFormattingProcessor());

        return $log;
    }

    private function getLogLevel() : Level
    {
        $levelAsString = ENV::get(ENV::LOG_LEVEL);
        return (new ReflectionEnum(Level::class))->getCase($levelAsString)->getValue();
    }

    private function getFormatter() : FormatterInterface
    {
        $dateFormat = 'Y-m-d\TH:i:s.v';
        $output = "%datetime% [%extra.padded_level%] %extra.padded_channel%: %message% %context%\n";
        $formatter = new LineFormatter($output, $dateFormat);
        return $formatter; 
    }


    private function getFormattingProcessor() : ProcessorInterface
    {
        $paddingProcessor = new class implements ProcessorInterface {
            public function __invoke(LogRecord $record)
            {
                $record->extra['padded_level'] = str_pad($record->level->getName(), 7, ' ', STR_PAD_RIGHT);
                $record->extra['padded_channel'] = str_pad($record->channel, 30, ' ', STR_PAD_RIGHT);
                return $record;
            }
        };
        return $paddingProcessor;
    }
}
