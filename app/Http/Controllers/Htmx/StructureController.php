<?php

namespace App\Http\Controllers\Htmx;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Structure\Email;
use App\Models\Structure\Tag;
use App\Models\Structure\Person;
use App\Models\Structure\Campaign;

class StructureController extends Controller
{
    public function index()
    {
        $emails_query = Email::latest();
        
        if (request('status') == 'active' || request('status') == 'complete') {
            $emails_query->where('status', request('status'));
        }

        if (request('query')) {
            $emails_query->where(function($sub) {
                return $sub->where('subject', 'LIKE', '%'.request('query').'%')
                           ->orWhere('full_text', 'LIKE', '%'.request('query').'%');
            });
        }

        $emails = $emails_query->take(200)->get();
        $tags = Tag::all()->sortBy('name');
        $campaigns = Campaign::all()->sortBy('name');

        return view('demos.htmx-structure.main', compact('emails', 'tags', 'campaigns'));
    }
    public function rowEdit($id)
    {
        $email = Email::with('people', 'campaigns', 'tags')->find($id);
        $tags = Tag::all()->sortBy('name');
        $campaigns = Campaign::all()->sortBy('name');
        return view('demos.htmx-structure.row-edit', compact('email', 'tags', 'campaigns'));
    }
    public function row($id)
    {
        $email = Email::with('people', 'campaigns', 'tags')->find($id);
        $tags = Tag::all()->sortBy('name');
        $campaigns = Campaign::all()->sortBy('name');
        return view('demos.htmx-structure.row', compact('email', 'tags', 'campaigns'));
    }
    public function toggleActive($id)
    {
        $email = Email::find($id);
        if ($email->status == 'active') {
            $email->status = 'complete';
        } else {
            $email->status = 'active';
        }
        $email->save();
        return view('demos.htmx-structure.status', compact('email'));   
    }
    public function tagLink($id)
    {
        $email = Email::find($id);
        $tagId = request('tag_id');
        $email->tags()->syncWithoutDetaching([$tagId]);
        
        $tags = Tag::all()->sortBy('name');
        $campaigns = Campaign::all()->sortBy('name');
        return view('demos.htmx-structure.row-edit', compact('email', 'tags', 'campaigns'));   
    }
    public function tagUnlink($id)
    {
        $email = Email::find($id);
        $tagId = request('tag_id');
        $email->tags()->detach([$tagId]);
        
        $tags = Tag::all()->sortBy('name');
        $campaigns = Campaign::all()->sortBy('name');
        return view('demos.htmx-structure.row-edit', compact('email', 'tags', 'campaigns'));  
    }
    public function personLink($id)
    {
        $email = Email::find($id);
        $personId = request('person_id');
        $email->people()->syncWithoutDetaching([$personId]);
        
        $tags = Tag::all()->sortBy('name');
        $campaigns = Campaign::all()->sortBy('name');
        return view('demos.htmx-structure.row-edit', compact('email', 'tags', 'campaigns'));   
    }
    public function personUnlink($id)
    {
        $email = Email::find($id);
        $personId = request('person_id');
        $email->people()->detach([$personId]);
        
        $tags = Tag::all()->sortBy('name');
        $campaigns = Campaign::all()->sortBy('name');
        return view('demos.htmx-structure.row-edit', compact('email', 'tags', 'campaigns'));   
    }
    public function campaignLink($id)
    {
        $email = Email::find($id);
        $campaignId = request('campaign_id');
        $email->campaigns()->syncWithoutDetaching([$campaignId]);
        
        $tags = Tag::all()->sortBy('name');
        $campaigns = Campaign::all()->sortBy('name');
        return view('demos.htmx-structure.row-edit', compact('email', 'tags', 'campaigns'));  
    }
    public function campaignUnlink($id)
    {
        $email = Email::find($id);
        $campaignId = request('campaign_id');
        $email->campaigns()->detach([$campaignId]);
        
        $tags = Tag::all()->sortBy('name');
        $campaigns = Campaign::all()->sortBy('name');
        return view('demos.htmx-structure.row-edit', compact('email', 'tags', 'campaigns'));  
    }
    public function peopleLookup($id)
    {
        $email = Email::find($id);
        $lookup = request('lookup');
        $people = [];
        if ($lookup) {
            $people = Person::where('name', 'LIKE', $lookup.'%')
                            ->orWhere('name', 'LIKE', '% '.$lookup.'%')
                            ->take(20)
                            ->orderBy('name')
                            ->get();
        }
        sleep(1);
        return view('demos.htmx-structure.lookup', compact('people', 'email'));
    }
}
