<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class RelatedProducts extends Component
{
    use WithPagination;

    public $product;
    public $search = '';
    public $perPage = 10;

    protected $queryString = ['search' => ['except' => '']];

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        $relatedProducts = Product::where('category_id', $this->product->category_id)
            ->where('id', '!=', $this->product->id)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        return view('livewire.related-products', [
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
