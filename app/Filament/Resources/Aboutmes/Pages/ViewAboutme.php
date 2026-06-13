<?php

namespace App\Filament\Resources\Aboutmes\Pages;

use App\Filament\Resources\Aboutmes\AboutmeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAboutme extends ViewRecord
{
    protected static string $resource = AboutmeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
