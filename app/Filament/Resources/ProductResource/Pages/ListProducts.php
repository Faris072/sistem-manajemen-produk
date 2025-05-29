<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use App\Exports\ProductExport;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('importProducts')
                ->label('Import Products')
                ->modalHeading('Import Products from Excel')
                ->form([
                    FileUpload::make('excel_file')
                        ->label('Excel File')
                        ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])
                        ->required()
                ])
                ->action(function (array $data) {
                    try {
                        Excel::import(new ProductImport, $data['excel_file']);

                        Notification::make()
                            ->title('Products imported successfully!')
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Error importing products!')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
            Actions\Action::make('exportProducts')
                ->label('Export Products')
                ->action(function () {
                    return Excel::download(new ProductExport, 'products.xlsx');
                })
                ->color('success'),
        ];
    }
}
