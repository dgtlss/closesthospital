<?php

namespace App\View\Components;

use Illuminate\View\Component;
Use App\Models\Hospital;
use Illuminate\Http\Request;

class closesthospital extends Component
{

    public $hospitals;
    public $request;
    public $Api;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        // get all hospitals from the database
        $this->hospitals = Hospital::all();
        $this->request = $request->getClientIP();

        $ipAddress = $this->request;
        $location = geoip()->getLocation($ipAddress);

        $hospitals = $this->hospitals;
        foreach($hospitals as $hospital){
            $hospital->distanceTo = $this->distance($location->lat, $location->lon, $hospital->latitude, $hospital->longitude, "M");
        }
        $hospitals = $hospitals->sortBy('distanceTo')->take(8);
        $dateUpdated = $hospitals->first()->created_at;
        $dateUpdated = date('D dS M Y H:iA', strtotime($dateUpdated));


        //dd($location);
        $this->Api = $Api = (object)[
            'location' => $location,
            'hospitals' => $hospitals,
            'dateUpdated' => $dateUpdated
        ];
    }

    public function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
          return 0;
        }
        else {
          $theta = $lon1 - $lon2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515;
          $unit = strtoupper($unit);
      
          if ($unit == "K") {
            return ($miles * 1.609344);
          } else if ($unit == "N") {
            return ($miles * 0.8684);
          } else {
            return $miles;
          }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.closesthospital')->with('Api', $this->Api);
    }
}
