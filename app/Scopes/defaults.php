<?php
namespace App\Scopes;
use App\Models\Source;
use App\Models\Designation;
use App\Models\PriorityLevel;
use App\Models\Segment;
use App\Models\Stage;
use App\Models\Tag;

trait defaults{
    public function createDefaultSources($client){

        $defaultSources=config('default.defaultSources');
        foreach($defaultSources as $source){

            Source::create([
                "sources"=>$source,
                'client_id'=>$client->id,
            ]);
        }
    }

    public function createDefaultTags($client){

        $defaultTags=config('default.defaultTags');
        foreach($defaultTags as $tag){

            Tag::create([
                "tags"=>$tag,
                'client_id'=>$client->id,
            ]);
        }
    }
    public function createDefaultDesignations($client){

        $defaultDesignations=config('default.defaultDesignations');
        foreach($defaultDesignations as $designation){

            Designation::create([
                "designation"=>$designation,
                'client_id'=>$client->id,
            ]);
        }
    }

    public function createDefaultSegments($client){

        $defaultSegments=config('default.defaultSegments');
        foreach($defaultSegments as $segment){

            Segment::create([
                "segments"=>$segment,
                'client_id'=>$client->id,
            ]);
        }
    }

    public function createDefaultStages($client){

        $defaultStages=config('default.defaultStages');
        foreach($defaultStages as $stage){

            Stage::create([
                "stages"=>$stage,
                'client_id'=>$client->id,
            ]);
        }
    }

    public function createDefaultPriorityLevel($client){

        $defaultPriorityLevel=config('default.defaultPriorityLevel');
        foreach($defaultPriorityLevel as $level){

            PriorityLevel::create([
                "level"=>$level,
                'client_id'=>$client->id,
            ]);
        }
    }


}