<?php

namespace App\Filament\Resources\Cooperations\Pages;

use App\Filament\Resources\Cooperations\CooperationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCooperation extends ViewRecord
{
    protected static string $resource = CooperationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
