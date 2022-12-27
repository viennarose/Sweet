<div>
    <div>
        @include('livewire.user.create')
        @include('livewire.user.edit')
        @include('livewire.user.delete')
        <div class="card">
            <div class="card-header d-flex">
                <h3 class="text-center fw-bold mt-3" style="font-family: Fantasy;">Cake Orders</h3>
                <div class="d-flex ms-auto input-group w-50">
                    <a data-bs-toggle="modal" data-bs-target="#orderModal" class="ms-auto mt-3 btn btn-primary">
                        Add
                    </a>
                </div>
            </div>
    <div class="card-body table-responsive">
        <table id="example1" class="table table-borderd table-sm table-hover">
            <thead class="text-center table-primary">
                <tr >
                    <th>ID</th>
                    @role('admin')
                    <th>User</th>
                    @endrole
                    <th>Category</th>
                    <th>Theme</th>
                    <th>Layers</th>
                    <th>Delivery Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @role('admin')
                @foreach ( $orders as $order)
                <tr class="text-center">
                    <td class="text-center">{{$order->id}}</td>
                    <td class="text-center">{{$order->users->name}}</td>
                    <td class="text-center">{{$order->category->category_name}}</td>
                    <td class="text-center">{{$order->theme}}</td>
                    <td class="text-center">{{$order->layers}}</td>
                    <td class="text-center">{{$order->delivery_date}}</td>
                    <td> <a type="button" data-bs-toggle="modal" data-bs-target="#updateorderModal" class="btn btn-primary" wire:click="editOrder({{$order->id}})">
                        Edit</a>
                        <a type="button" data-bs-toggle="modal" class="btn btn-danger" data-bs-target="#deleteorderModal" wire:click="deleteOrder({{$order->id}})">
                            Delete</a>
                </td>
                </tr>
                @endforeach
                @endrole
                @role('user')
                @foreach ( $orders as $order)
                @if($order->user_id == auth()->id())
                <tr>
                    <td class="text-center">{{$order->id}}</td>
                    <td class="text-center">{{$order->category->category_name}}</td>
                    <td class="text-center">{{$order->theme}}</td>
                    <td class="text-center">{{$order->layers}}</td>
                    <td class="text-center">{{$order->delivery_date}}</td>
                    <td> <a type="button" data-bs-toggle="modal" class="btn btn-primary" data-bs-target="#updateorderModal" wire:click="editOrder({{$order->id}})">
                        Edit</a>
                        <a type="button" data-bs-toggle="modal" class="btn btn-danger" data-bs-target="#deleteorderModal" wire:click="deleteOrder({{$order->id}})">
                            Delete</a>
                </td>
                </tr>
                @endif
                @endforeach
                @endrole
            </tbody>
        </table>
    </div>
    </div>
    </div>
</div>
