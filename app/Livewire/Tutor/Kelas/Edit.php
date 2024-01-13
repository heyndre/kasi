<?php

namespace App\Livewire\Tutor\Kelas;

use App\Models\Course;
use Livewire\Component;

class Edit extends Component
{
    public $data, $topic, $lesson, $reference, $links;

    public function updateClass() {
        // dd($this);

        $this->data->update([
            'topic' => $this->topic,
            'lesson_matter' => $this->lesson,
            // 'additional_links' => json_encode($this->reference),
        ]);
        if ($this->reference != $this->links) {
            // dd($this->reference == $this->links);
            // dd($this);
            $this->data->update([
            'additional_links' => json_encode($this->reference),
            ]);
        }

        session()->flash('success', 'Pembaruan detail kelas berhasil');
        return $this->redirect(route('tutor.classes.show', ['id' => $this->data->id]), navigate: false);
    }

    public function mount($id) {
        $this->data = Course::where('id', $id)->firstOrFail();
        $this->topic = $this->data->topic;
        $this->lesson = $this->data->lesson_matter;
        $this->reference = $this->data->additional_links;
        $this->links = $this->data->additional_links;

        
    }
    public function render()
    {
        return view('livewire.tutor.kelas.edit');
    }
}
