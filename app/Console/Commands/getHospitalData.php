<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Hospital;
use Illuminate\Support\Facades\Http;

class getHospitalData extends Command
{
    public $w3wKey = 'XW333WKY';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:hospitalinfo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get hospital data from JSON file and add it to the DB';

    public function what3words($lng,$lat){
        $whatWords = Http::get('https://api.what3words.com/v3/convert-to-3wa?coordinates='.$lat.','.$lng.'&key='.$this->w3wKey)
        ->object();

        return $whatWords->words;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(){
        // get information from the JSON file
        $json = file_get_contents('https://raw.githubusercontent.com/rboulton/ukhospitals/master/hosplocs.json');

        // decode the JSON file
        $data = json_decode($json, true);

        // Clear out the hospital data table
        Hospital::truncate();

        // Loop through the hospitals and add them to the DB
        foreach($data as $hospital){
            $this->info('Adding hospital: '.$hospital['name']);
            
            // create a new hospital in DB
            $newHospital = new Hospital();
            $newHospital->hospital_name = $hospital['name'];
            if($hospital['hasaande'] == false){
                $newHospital->hasaande = 0;
            }else{
                $newHospital->hasaande = 1;
            }
            $newHospital->address = $hospital['address'];
            $newHospital->postcode = $hospital['postcode'];
            $newHospital->latitude = $hospital['latitude'];
            $newHospital->longitude = $hospital['longitude'];
            if(isset($hospital['telephone'])){
                $newHospital->phone_number = $hospital['telephone'];
            }
            if(isset($hospital['url'])){
                $newHospital->website = $hospital['url'];
            }
            // Get the what 3 words location
            $w3w = $this->what3words($hospital['longitude'],$hospital['latitude']);
            $newHospital->w3w = $w3w;

            $newHospital->save();

            $this->info('Hospital added Succesfully: '.$hospital['name']. ' What 3 Words location: '.$w3w);
        }

        $this->info('Hospital data added Succesfully');
    }
}
