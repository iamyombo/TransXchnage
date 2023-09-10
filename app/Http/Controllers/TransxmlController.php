<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;
use Orchestra\Parser\Xml\Facade as TransXmlParser;
use illuminate\Support\Arr;
use App\Models\Transxchange as TransXchangeTB;
use App\Models\NptgLocalitiesAnlr as NptgTB;
use App\Models\Stoppoint as StopPointsTB;
use App\Models\Routesection as RoutesSectionsTB;
use App\Models\RouteLink as RoutesLinksTB;
use App\Models\RouteLinkMappingLocation as RoutesLinksTrackLocationsTB;
use App\Models\Routesxml as RoutesTB;
use App\Models\Jpsectionxml as JourneyPatternSectionTB;
use App\Models\Jptiminglinkxml as JourneyPatternTimingLinkTB;
use App\Models\Operatorxml as OperatorTB;
use App\Models\Operatoraddressxml as OperatorAddressTB;
use App\Models\Operatorgaragexml as OperatorGarageTB;
use App\Models\Servicesxml as ServicesTB;
use App\Models\Servicesstandardxml as SevicesStandardTB;
use App\Models\Servicesjourneypatternxml as SevicesStandardJPTB;
use App\Models\Vehiclejourneyxml as VJTB;



class TransxmlController extends Controller
{

        /**
         * Load the XML file into into $transxchange object variable.
         *
         */

        function loadxml(){


            $transxchangexml = TransXmlParser::load('C:\Users\muniru\myportfolio\TransXchangeXML\storage\app\public\xml-tx\mer_1-3C-_-y11-19.xml');

        echo "<pre>";
           print_r($transxchangexml);
           echo "</pre>";




        }

        function pushxml(){


            /**
             *
             * Loading XML File
             * Convert XML File to Array
             *
             */

            // Transxchange XML file name and path.
            $pathxml = "C:\Users\muniru\myportfolio\TransXchangeXML\storage\app\public\xml-tx\mer_1-3C-_-y11-19.xml";

            $transxmlfile = file_get_contents($pathxml);     // Read the transxchnage in a string variable
            $transxchangeObj = simplexml_load_string($transxmlfile);    // Create an object from transxmlfile to access content data.
            $transxchangeJson = json_encode($transxchangeObj);          // Convert XML into array via json to generate associate array of xml elements with values
            $transxchangeArray = json_decode($transxchangeJson, true);      // Data Array created.

            echo "<pre>";
            //print_r($transxchangeArray);
            echo "</pre>";

            /**
             *
             * Create XML File Details
             * Saving XML File Attributes to the database
             * Table Name: [transxchanges]
             *
             *
             */
            // Get the file parameter XML file unique attributes
            $transxchangeAttrArray = $transxchangeArray['@attributes']; // Assign the Attributes to an array.
            $FileName = Arr::get($transxchangeAttrArray, 'FileName'); // XML File Name.

            // Checking if file already exist in the system.
            if (TransXchangeTB::where('xmlFileName', $FileName)->exists()) {

            // XML FILE ALREADY PROCESSED.
            echo "XML FILE: <b>". $FileName ."</b> HAS BEEN PROCESSED";

            }else{

                $transxchangeAttrArrayTB = TransXchangeTB::Create([

                'xmlFileName' =>  $FileName = Arr::get($transxchangeAttrArray, 'FileName'), // XML File Name.
                'xmlModStatus' => $ModStatus = Arr::get($transxchangeAttrArray, 'Modification'), // XML File Modification.
                'xmlCreateDate' => $CreateDate =   Arr::get($transxchangeAttrArray, 'CreationDateTime'), // XML File Creation Date.
                'xmlModDate' => $ModDate =  Arr::get($transxchangeAttrArray, 'ModificationDateTime'), // XML File Modification Date.
                'xmlRevisionNo' => $RevisionNo =   Arr::get($transxchangeAttrArray, 'RevisionNumber'), // XML File Revision Number.
                'xmlSchemaVer' => $SchemaVer = Arr::get($transxchangeAttrArray, 'SchemaVersion'), // XML File SchemaVersion.

                ]);

            }




            /**WORKING ON <NptgLocalities>...</NptgLocalities>
             *
             * Get the ID of the XML if into memory
             * Post AnnotatedNptgLocalityRef to the DB
             * Table Name: [nptg_localities_anlrs]
             *
             */

            //  Get XML FILE ID
            $xmlID = TransXchangeTB::where('xmlFileName',  $FileName)->first(['id'])->id;
            //dd($xmlID);

            // Get XML element NptgLocalities into array variable.
            $xmlNptgLocalitiesArray = $transxchangeArray['NptgLocalities']['AnnotatedNptgLocalityRef'];
            $xmlNptgArrayCount = count($xmlNptgLocalitiesArray);


            // Saving all the AnnotatedNptgLocalityRef to table
            if ($xmlNptgArrayCount > 0) {

                foreach ($xmlNptgLocalitiesArray as $key => $NptgLocality ) {

                        $xmlNptgLocalitiesArrayTB = NptgTB::Create([

                        'transxchanges_id' => $xmlID,   // XML System Generated File ID  Number.
                        'anlr_ref' =>  $NptgLocality['NptgLocalityRef'],    // Nptg Locality Reference.
                        'anlr_name' => $NptgLocality['LocalityName'],   // Nptg Locality Name.

                    ]);

                }

            }







            /**WORKING ON <StopPoints>...</StopPoints>
             *
             * Reference $xmlID for XML File ID
             * Post StopPoints to the DB
             * Table Name: [stoppoints]
             *
             */

                // Get XML element StopPoints into array variable.
                $xmlStopPointsArray = $transxchangeArray['StopPoints']['StopPoint'];
                $xmlStopPointsCount = count($xmlStopPointsArray);

                // Saving all the Stoppoints to table
                if ($xmlStopPointsCount > 0) {

                foreach ($xmlStopPointsArray as $key => $xmlStopPoint ) {

                    $xmlStopPointsArrayTB = StopPointsTB::Create([

                        'transxchanges_id' => $xmlID, // XML System Generated File ID  Number / TransXchnage System Foreign Key.
                        'creationdate' =>    $xmlStopPoint['@attributes']['CreationDateTime'], // Stoppoints CreationDate CDATE to retrieve.
                        'atcocode'  =>  $xmlStopPoint['AtcoCode'],   // Stoppoints AtcoCode.
                        'dcname'   =>  $xmlStopPoint['Descriptor']['CommonName'],   // Stoppoints Descriptor Common Name.
                        'pnptgref' =>  $xmlStopPoint['Place']['NptgLocalityRef'],// Stoppoints Place NptgLocalityRef.
                        'pllong'  =>  $xmlStopPoint['Place']['Location']['Longitude'], // Stoppoints Place Location Longitude.
                        'pllati'  =>  $xmlStopPoint['Place']['Location']['Latitude'], // Stoppoints Place Location Latitude.
                        'sctype'   =>  $xmlStopPoint['StopClassification']['StopType'], // Stoppoints Stop Classification Type.
                        'baystatus' => $xmlStopPoint['StopClassification']['OffStreet']['BusAndCoach']['Bay']['TimingStatus'],   // Stoppoints Stop Classification Offstreet Bus & Coach.
                        'aaref'    =>  $xmlStopPoint['AdministrativeAreaRef'],//Stoppoint Administrative Area Ref.
                        'notes'   =>  $xmlStopPoint['Notes'], //Stoppoint Notes.

                    ]);
                };
            };




            /**WORKING ON <RouteSections>...</RouteSections>
             *
             * Reference $xmlID for XML File ID
             * Post RouteSections to the DB
             * Table Name: [routesections]
             *
             */

                // Get XML element RouteSections into array variable.
                $xmlRouteSectionsArray = $transxchangeArray['RouteSections']['RouteSection'];
                $xmlRouteSectionsCount = count($xmlRouteSectionsArray);

                // Saving all the RouteSections to table
                if ($xmlRouteSectionsCount > 0) {

                        foreach ( $xmlRouteSectionsArray as $key => $xmlRouteSection ) {

                        $xmlRouteSectionsArrayTB = RoutesSectionsTB::Create([

                        'transxchanges_id' => $xmlID, // XML System Generated File ID  Number / TransXchnage System Foreign Key.
                        'RSID' => $xmlRouteSection['@attributes']['id'],    // Route Section ID

                        ]);



                        $rlcount = count($xmlRouteSection['RouteLink']);

                        for ( $i=0; $i < $rlcount; $i++ ) {

                            $xmlRouteSectionsRouteLinksArrayTB = RoutesLinksTB::Create([

                            'RSID'=> $xmlRouteSection['@attributes']['id'], // Routs Session ID Foreign Key from Routesections table.
                            'RLID'=> $xmlRouteSection['RouteLink'][$i]['@attributes']['id'], // Route Link ID.
                            'RL_FROM_STOP_POINT_REF'=> $xmlRouteSection['RouteLink'][$i]['From']['StopPointRef'], // Route Link FROM stop point Ref = Stop point ATCODE.
                            'RL_TO_STOP_POINT_REF'=> $xmlRouteSection['RouteLink'][$i]['To']['StopPointRef'], // Route Link TO stop point Ref = Stop point ATCODE.
                            'RL_DISTANCE'=> $xmlRouteSection['RouteLink'][$i]['Distance'], // Route Link Distance.
                            'RL_DIRECTION'=> $xmlRouteSection['RouteLink'][$i]['Direction'] , // Route Link Direction.

                            ]);



                        $rlcounttrack = count($xmlRouteSection['RouteLink'][$i]['Track']['Mapping']['Location']);

                        for ( $a=0; $a < $rlcounttrack; $a++ ) {

                            $xmlRouteSectionsRouteLinksMapLocationArrayTB = RoutesLinksTrackLocationsTB::Create([

                                'RL_TML_ID'=> $xmlRouteSection['RouteLink'][$i]['@attributes']['id'], // Route Link ID.
                                'RL_TML_LONGITUDE'=> $xmlRouteSection['RouteLink'][$i]['Track']['Mapping']['Location'][$a]['Longitude'], // Route Link Track Mapping Location Longitude.
                                'RL_TML_LATITUDE'=> $xmlRouteSection['RouteLink'][$i]['Track']['Mapping']['Location'][$a]['Latitude'], // Route Link Track Mapping Location Latitude.

                            ]);

                        };

                     };

                    };

                };






            /**WORKING ON <Routes>...</Routes>
             *
             * Reference $xmlID for XML File ID
             * Post Routes to the DB
             * Table Name: [routesxml]
             *
             */

                // Get XML element Routes into array variable.
                $xmlRoutesArray = $transxchangeArray['Routes']['Route'];
                $xmlRoutesCount = count($xmlRoutesArray);


                // Saving all the Routes to table
                if ($xmlRoutesCount > 0) {

                foreach ( $xmlRoutesArray as $key => $xmlRoute ) {


                    $xmlRoutesArrayTB = RoutesTB::Create([


                    'transxchanges_id' => $xmlID,       // TransXchnage System Foreign Key.
                    'RID' => $xmlRoute['@attributes']['id'],         // Routes Id.
                    'privatecode' => $xmlRoute['PrivateCode'],       // Route Private Code.
                    'description' => $xmlRoute['Description'],       // Route Description.
                    'routesectionref' => $xmlRoute['RouteSectionRef'],      // Route Section Ref.


                    ]);


                };

            };



            /**WORKING ON <JourneyPatternSections>...<JourneyPatternSections>
             *
             * Reference $xmlID for XML File ID
             * Post JourneyPatternSection to the DB
             * Table Name: [jpsectionxml]
             *
             */

                // Get XML element JourneyPatternSections into array variable.
                $xmlJourneyPatternSectionsArray = $transxchangeArray['JourneyPatternSections']['JourneyPatternSection'];
                $xmlJourneyPatternSectionsCount = count($xmlJourneyPatternSectionsArray);


                // Saving all the JourneyPatternSections to table
                if ($xmlJourneyPatternSectionsCount > 0) {


                    foreach ( $xmlJourneyPatternSectionsArray as $key => $xmlJPSection ) {

                        $xmlJourneyPatternSectionArrayTB = JourneyPatternSectionTB::Create([


                            'transxchanges_id' => $xmlID,       // TransXchnage System Foreign Key.
                            'JPSID' => $xmlJPSection['@attributes']['id'], //Journey Pattern Session ID

                             ]);


                         $jptlcount = count($xmlJPSection['JourneyPatternTimingLink']);

                         for ( $i=0; $i < $jptlcount; $i++ ) {

                             $xmlJourneyPatternTimingLinkArrayTB = JourneyPatternTimingLinkTB::Create([


                             'JPSID' =>  $xmlJPSection['@attributes']['id'], //Journey Pattern Session ID
                             'JPTLID' =>  $xmlJPSection['JourneyPatternTimingLink'][$i]['@attributes']['id'], // Journey Pattern Timing Link ID Foreign Key from jpsectionxmls table.
                             'JPTL_FROM_SEQUENCE' => $xmlJPSection['JourneyPatternTimingLink'][$i]['From']['@attributes']['SequenceNumber'], //  FROM Sequence.
                             'JPTL_ACTIVITY_FROM' => $xmlJPSection['JourneyPatternTimingLink'][$i]['From']['Activity'], // FROM Activity.
                             'JPTL_FROM_DDD' => $xmlJPSection['JourneyPatternTimingLink'][$i]['From']['DynamicDestinationDisplay'], // FROM Dynamic Destination Display.
                             'JPTL_FROM_STOP_POINT_REF' => $xmlJPSection['JourneyPatternTimingLink'][$i]['From']['StopPointRef'], // FROM StopPointRef.
                             'JPTL_FROM_TIMING_STATUS' => $xmlJPSection['JourneyPatternTimingLink'][$i]['From']['TimingStatus'], // FROM Timing Status.
                             'JPTL_TO_SEQUENCE' => $xmlJPSection['JourneyPatternTimingLink'][$i]['To']['@attributes']['SequenceNumber'], // TO Sequence.
                             'JPTL_ACTIVITY_TO' => $xmlJPSection['JourneyPatternTimingLink'][$i]['To']['Activity'], // TO Activity.
                             'JPTL_TO_DDD' => $xmlJPSection['JourneyPatternTimingLink'][$i]['To']['DynamicDestinationDisplay'], // TO Dynamic Destination Display.
                             'JPTL_TO_STOP_POINT_REF' => $xmlJPSection['JourneyPatternTimingLink'][$i]['To']['StopPointRef'], // TO StopPointRef.
                             'JPTL_TO_TIMING_STATUS' => $xmlJPSection['JourneyPatternTimingLink'][$i]['To']['TimingStatus'], // TO Timing Status.
                             'JPTL_ROUTE_LINK_REF' => $xmlJPSection['JourneyPatternTimingLink'][$i]['RouteLinkRef'], // Route Link Ref Linked to ROUTE LINK ID (route_links:RLID)
                             'JPTL_RUNTIME' => $xmlJPSection['JourneyPatternTimingLink'][$i]['RunTime'], // Journey Pattern Timing Run Time.
                             ]);



                         };

                    };

                };










        }



}
