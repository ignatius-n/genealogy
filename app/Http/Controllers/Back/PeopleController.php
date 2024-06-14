<?php

declare(strict_types=1);

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Couple;
use App\Models\Person;
use Illuminate\View\View;

class PeopleController extends Controller
{
    public function search(): View
    {
        return view('back.people.search');
    }

    public function birthdays($months = 2): View
    {
        $people = Person::whereNotNull('dob')
            ->whereRaw('CASE WHEN MONTH(NOW()) +' . $months . " > 12 THEN date_format(dob, '%m-%d') >= date_format(NOW(), '%m-%d') OR date_format(dob, '%m-%d') <= date_format(NOW() + INTERVAL " . $months . " MONTH, '%m-%d') ELSE date_format(dob, '%m-%d') >= date_format(NOW(), '%m-%d') AND date_format(dob, '%m-%d') <= date_format(NOW() + INTERVAL " . $months . " MONTH, '%m-%d') END")
            ->orderByRaw("(case when date_format(dob, '%m-%d') >= date_format(now(), '%m-%d') then 0 else 1 end), date_format(dob, '%m-%d')")
            ->get();

        return view('back.people.birthdays')->with(compact('months', 'people'));
    }

    public function add(): View
    {
        return view('back.people.add.person');
    }

    public function show(Person $person): View
    {
        return view('back.people.show')->with(compact('person'));
    }

    public function ancestors(Person $person): View
    {
        return view('back.people.ancestors')->with(compact('person'));
    }

    public function descendants(Person $person): View
    {
        return view('back.people.descendants')->with(compact('person'));
    }

    public function chart(Person $person): View
    {
        return view('back.people.chart')->with(compact('person'));
    }

    public function files(Person $person): View
    {
        return view('back.people.files')->with(compact('person'));
    }

    public function history(Person $person): View
    {
        return view('back.people.history')->with(compact('person'));
    }

    public function addFather(Person $person): View
    {
        return view('back.people.add.father')->with(compact('person'));
    }

    public function addMother(Person $person): View
    {
        return view('back.people.add.mother')->with(compact('person'));
    }

    public function addChild(Person $person): View
    {
        return view('back.people.add.child')->with(compact('person'));
    }

    public function addPartner(Person $person): View
    {
        return view('back.people.add.partner')->with(compact('person'));
    }

    public function editContact(Person $person): View
    {
        return view('back.people.edit.contact')->with(compact('person'));
    }

    public function editDeath(Person $person): View
    {
        return view('back.people.edit.death')->with(compact('person'));
    }

    public function editFamily(Person $person): View
    {
        return view('back.people.edit.family')->with(compact('person'));
    }

    public function editPhotos(Person $person): View
    {
        return view('back.people.edit.photos')->with(compact('person'));
    }

    public function editProfile(Person $person): View
    {
        return view('back.people.edit.profile')->with(compact('person'));
    }

    public function editPartner(Person $person, Couple $couple): View
    {
        return view('back.people.edit.partner')->with(compact('person', 'couple'));
    }
}
