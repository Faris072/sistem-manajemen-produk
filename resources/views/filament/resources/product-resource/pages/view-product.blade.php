<x-filament-panels::page>
    {{ $this->form }}
    <div class="mt-8">
        @livewire('related-products', ['product' => $record])
    </div>
</x-filament-panels::page>
