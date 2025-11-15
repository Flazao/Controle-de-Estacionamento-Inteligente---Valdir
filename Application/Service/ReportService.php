<?php

namespace Application\Service;

class ReportService
{
    private array $history;

    public function __construct(array &$history)
    {
        $this->history = &$history;
    }

    public function generate(): array
    {
        $report = [
            'car' => ['count' => 0, 'total' => 0],
            'motorcycle' => ['count' => 0, 'total' => 0],
            'truck' => ['count' => 0, 'total' => 0],
        ];

        foreach ($this->history as $record) {
            $type = $record['type'];
            $report[$type]['count']++;
            $report[$type]['total'] += $record['tariff'];
        }

        return $report;
    }
}
