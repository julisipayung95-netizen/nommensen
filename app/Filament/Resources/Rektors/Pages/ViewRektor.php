<?php

namespace App\Filament\Resources\Rektors\Pages;

use App\Filament\Resources\Rektors\RektorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRektor extends ViewRecord
{
    protected static string $resource = RektorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
