<?php

namespace App\Filament\Resources\Greetings\Pages;

use App\Filament\Resources\Greetings\GreetingResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewGreeting extends ViewRecord
{
    protected static string $resource = GreetingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
