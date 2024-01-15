<?php

namespace App\Livewire\Admin\KBM;

use App\Models\Tutor;
use App\Models\Course;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\Features\SupportFileUploads\WithFileUploads as SupportFileUploadsWithFileUploads;
use Livewire\WithFileUploads;
use Spatie\Image\Image as Image;
use Spatie\Image\Manipulations;
use Illuminate\Support\Facades\File;

class Edit extends Component
{
    use SupportFileUploadsWithFileUploads;

    public $data, $topic, $lesson, $reference, $links, $availability, $files = [], $photo, $recording = [];

    public function updatedFiles() {
        // dd($this->files);
    }

    public function updateClass()
    {
        dd($this);

        $this->data->update([
            'topic' => $this->topic,
            'lesson_matter' => $this->lesson,
            // 'additional_links' => json_encode($this->reference),
        ]);
        if ($this->reference != $this->links) {
            dd($this->reference == $this->links);
            // dd($this);
            // $this->data->update([
            // 'additional_links' => json_encode($this->reference),
            // ]);
        }

        session()->flash('success', 'Pembaruan detail kelas berhasil');
        return $this->redirect(route('kbm.show', ['id' => $this->data->id]), navigate: false);
    }

    public function mount($id)
    {
        $this->data = Course::where('id', $id)->firstOrFail();
        $this->topic = $this->data->topic;
        $this->lesson = $this->data->lesson_matter;
        $this->reference = $this->data->additional_links;
        $this->links = $this->data->additional_links;
        $this->files = json_decode($this->data->files);
    }

    public function render()
    {
        // dd($this);
        return view('livewire.admin.kbm.edit');
    }
}
