<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteStoreRequest;
use App\Note;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
class NoteController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (request()->ajax()) {
            return response()->json(Note::get()->flatten(1)->toArray());
        }
        return view('notes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteStoreRequest $request)
    {
        Note::create($request->only(['title', 'content']));
        return redirect()->route('note.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $note->title = $request->input('title');
        $note->content = $request->input('content');
        $note->save();
        return redirect()->route('note.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Note $note)
    {
        return view('notes.delete', compact('note'));
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('note.index');
    }
    public function share(Note $note)
    {
        return view('notes.share', compact('note'));
    }

    public function doShare(Note $note)
    {
        $this->validate(request(), ['contact_id' => 'required' ]);
        $request = request();
        $contact = User::find($request->input('contact_id'));
        if(!$contact) {
            return redirect()->back();
        }

        $content = $this->attachImage($note->content);

        $data['contact'] = $contact;
        $data['images'] = $content['images'];
        $data['template'] = $content['comment'];
        $data['note'] = $note;

        Mail::send('emails.note-share', $data, function ($message) use ($contact) {
            $message->to($contact->email)->cc(auth()->user()->getAttribute('email'))->subject(env('PRODUCT_NAME') . ' - '.$contact->name. ' - '. ' Note');
        });

        return redirect()->route('note.index');
    }

    private function attachImage($content)
    {
        $dom = new \DOMDocument();
        $dom->encoding = 'utf-8';
        @$dom->loadHTML(utf8_decode($content));
        $imageTags = $dom->getElementsByTagName('img');
        $imageInputTags = $dom->getElementsByTagName('input');

        $replace = [];
        $imageSrc = [];
        foreach ($imageTags as $key => $image) {
            $src = $image->getAttribute('src');
            $imageUrl = self::replaceImageUrl($src);
            if ($imageUrl) {
                $imageSrc[] = $imageUrl;
                $attributes = $image->attributes;
                while ($attributes->length) {
                    $image->removeAttribute($attributes->item(0)->name);
                }
                $image->setAttribute('src', $imageUrl);
                $replaceString = '<img src="'.$imageUrl.'">';
                $newDom = "<new-img img='$imageUrl'>";
                $replace[$newDom] = $replaceString;
            }
        }

        foreach ($imageInputTags as $key => $input) {
            $type =  $input->getAttribute('type');
            if ($type == "image") {
                $src = $input->getAttribute('src');
                $imageUrl = self::replaceImageUrl($src);
                if ($imageUrl) {
                    $imageSrc[] = $imageUrl;
                    $attributes = $input->attributes;
                    while ($attributes->length) {
                        $input->removeAttribute($attributes->item(0)->name);
                    }
                    $input->setAttribute('src', $imageUrl);
                    $replaceString = '<input src="'.$imageUrl.'">';
                    $newDom = "<new-img img='$imageUrl'>";
                    $replace[$newDom] = $replaceString;
                }
            }
        }

        $content = $dom->saveHTML();
        $content = str_replace('<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">', '', $content);
        $content = str_replace('<html><body>', '', $content);
        $content = str_replace('</body></html>', '', $content);

        foreach ($replace as $newDom => $oldDom) {
            $content = str_replace($oldDom, $newDom, $content);
        }

        return [
            'images' => $imageSrc,
            'comment' => $content
        ];
    }
}
