<div>
    <div>
        <div wire:ignore.self class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="orderModalLabel">Create Order</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <div class="form-floating mb-4">
                            <select class="form-select" name="category_id" wire:model.defer="category_id">
                                <option selected>Select category_id</option>
                                @foreach($category as $cat)
                                @if($cat->status==0)
                                    <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                @endif
                            @endforeach
                            </select>

                            <label for="category_id">Category</label>
                            @error('category_id')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label>Theme</label>
                            <input type="text" class="form-control" wire:model="theme">
                            @error('theme') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Layers</label>
                            <input type="string" class="form-control" wire:model="layers">
                            @error('layers') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Delivery Date</label>
                            <input type="date" class="form-control" wire:model="delivery_date">
                            @error('delivery_date') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" wire:click="addOrder()">Add Order</button>
                    </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
