<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use App\Models\CakeOrder;
use App\Models\CakeCategory;
use Livewire\WithPagination;

class Index extends Component
{
    public $search;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function loadOrders(){
        $query = CakeOrder::orderBy('delivery_date')
            ->search($this->search);

        $orders = $query->paginate(5);
        return compact('orders');
    }
    public function closeModal()
    {
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function back(){
        return redirect('/orders/');
    }

    public function resetInput()
    {
        $this->category_id = '';
        $this->theme = '';
        $this->layers = '';
        $this->delivery_date = '';
    }
    public $category_id, $theme, $layers, $delivery_date, $user_id;

    public function addOrder(){
        $this->validate([
            'category_id' => ['required', 'integer'],
            'theme' => ['required', 'string'],
            'layers' => ['required', 'string'],
            'delivery_date' => ['required', 'string'],
        ]);

        $order = CakeOrder::create([
            'user_id' => auth()->id(),
            'category_id' => $this->category_id,
            'theme' => $this->theme,
            'layers' => $this->layers,
            'delivery_date' => $this->delivery_date,
        ]);
        return redirect()->to('/orders');
        session()->flash('message','order Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function updateOrder(){
        $this->validate([
            'category_id' => ['required', 'integer'],
            'theme' => ['required', 'string'],
            'layers' => ['required', 'string'],
            'delivery_date' => ['required', 'string'],
        ]);
        $order = CakeOrder::findOrFail($this->order_id);
        $order->where('id',$this->order_id)->update([
            'category_id' => $this->category_id,
            'theme' => $this->theme,
            'layers' => $this->layers,
            'delivery_date' => $this->delivery_date,
        ]);
        return redirect()->to('/orders');
        session()->flash('message','Order Updated Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editOrder(int $order_id){
        $order = CakeOrder::find($order_id);
        if($order){
            $this->order_id = $order->id;
            $this->category_id = $order->category_id;
            $this->theme = $order->theme;
            $this->layers = $order->layers;
            $this->delivery_date = $order->delivery_date;
        }else{
            return redirect()->to('/orders');
        }
    }
    public function deleteOrder(int $order_id)
    {
        $this->order_id = $order_id;
    }

    public function destroyOrder()
    {
        CakeOrder::find($this->order_id)->delete();
        session()->flash('message','order Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
       $users = User::get();
       $category = CakeCategory::get();
        return view('livewire.user.index', compact('users', 'category'), $this->loadOrders());
    }
}
