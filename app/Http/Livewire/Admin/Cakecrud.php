<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\CakeCategory;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class Cakecrud extends Component
{

    public $search='';
    public $showData = true;
    public $createData = false;
    public $updateData = false;

    public $category_name;
    public $description;
    public $status;
    public $image;

    public $edit_id;
    public $edit_category_name;
    public $edit_description;
    public $edit_status;
    public $old_image;
    public $new_image;




    public function resetField()
    {
        $this->category_name = "";
        $this->description = "";
        $this->status = "";
        $this->image = "";
        $this->edit_category_name = "";
        $this->edit_description = "";
        $this->edit_status = "";
        $this->new_image = "";
        $this->old_image = "";
        $this->edit_id = "";
    }

    public function showForm()
    {
        $this->showData = false;
        $this->createData = true;
    }


    use WithFileUploads;
    public function create()
    {
        $images = new CakeCategory();
        $this->validate([
            'category_name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'image' => 'required'
        ]);

        $filename = "";
        if ($this->image) {
            $filename = $this->image->store('CakeCategorys', 'public');
        } else {
            $filename = Null;
        }

        $images->category_name = $this->category_name;
        $images->description = $this->description;
        $images->status = $this->status == true ? '1':'0';
        $images->image = $filename;
        $result = $images->save();
        if ($result) {
            session()->flash('success', 'Added Successfully');
            $this->resetField();
            $this->showData = true;
            $this->createData = false;
        } else {
            session()->flash('error', 'Create Unsuccessfully');
        }


    }

    public function edit($id)
    {
        $this->showData = false;
        $this->updateData = true;
        $images = CakeCategory::findOrFail($id);
        $this->edit_id = $images->id;
        $this->edit_category_name = $images->category_name;
        $this->edit_description = $images->description;
        $this->edit_status = $images->status == true ? '1':'0';
        $this->old_image = $images->image;
    }

    public function update($id)
    {
        $images =CakeCategory::findOrFail($id);
        $this->validate([
            'edit_category_name' => 'required',
            'edit_description' => 'required',
            'edit_status' => 'required',
        ]);

        $filename = "";
        $destination=public_path('storage\\'.$images->image);
        if ($this->new_image != null) {
            if(File::exists($destination)){
                File::delete($destination);
            }
            $filename = $this->new_image->store('CakeCategorys', 'public');
        } else {
            $filename = $this->old_image;
        }

        $images->category_name = $this->edit_category_name;
        $images->description = $this->edit_description;
        $images->status = $this->edit_status;
        $images->image = $filename;
        $result = $images->save();
        if ($result) {
            session()->flash('success', 'Updated Successfully');
            $this->resetField();
            $this->showData = true;
            $this->updateData = false;
        } else {
            session()->flash('error', 'Update UnSuccessfully');
        }
    }

    public function delete($id)
    {
        $images=CakeCategory::findOrFail($id);
        $destination=public_path('storage\\'.$images->image);
        if(File::exists($destination)){
            File::delete($destination);
        }

        $result=$images->delete();
        if ($result) {
            session()->flash('Success', 'Delete Successfully');
        } else {
            session()->flash('error', 'Not Delete Successfully');
        }
    }

    public function back(){
        $this->showData = true;
        $this->createData = false;
        $this->updateData = false;
    }

    public function render()
    {
        $images = CakeCategory::where('category_name', 'like', '%'.$this->search.'%')->orderBy('id','ASC')->paginate(5);
        return view('livewire.admin.cakecrud', ['images' => $images])->layout('layouts.app');
    }
}
