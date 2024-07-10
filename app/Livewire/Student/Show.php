<?php

namespace App\Livewire\Student;

use App\Models\Recommendation;
use App\Models\Student;
use App\Models\StudentCharacteristic;
use App\Models\StudentPreferences;
use App\Models\Tutor;
use App\Models\User;
use Google\Service\Recommender;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;


use Livewire\Component;

class Show extends Component
{
    public $status, $data, $preference, $recommendation = [], $char, $nim, $acronym, $photoUrl, $eduLevel, $acronymPlus, $name, $address, $birthday, $nextAnniversary, $whatsapp, $photo, $guardian, $hasGuardian, $guardianName, $guardianWhatsapp, $registeredAt, $lastLoginAt, $lastActiveAt, $eduStatus, $eduSite, $workSite, $workTitle;

    public function mount($nim)
    {
        $data = Student::with('userData', 'thePreference', 'theCharacteristic', 'theRecommendation')->where('nim', $nim)->firstOrFail();
        // dd($data);
        $this->data = $data;

        if ($data->thePreference == null) {
            $this->preference = [
                'duration' => null,
                'time_of_day' => null,
                'extra_open' => null,
                'extra_agree' => null,
                'extra_conscient' => null,
                'extra_duration' => null,
                'extra_TOD' => null,
                'open_agree' => null,
                'open_conscient' => null,
                'open_duration' => null,
                'open_TOD' => null,
                'agree_conscient' => null,
                'agree_duration' => null,
                'agree_TOD' => null,
                'conscient_duration' => null,
                'conscient_TOD' => null,
                'duration_TOD' => null,
            ];
        } else {
            $this->preference = [
                'duration' => $data->thePreference->duration,
                'time_of_day' => $data->thePreference->time_of_day,
                'extra_open' => $data->thePreference->extra_open,
                'extra_agree' => $data->thePreference->extra_agree,
                'extra_conscient' => $data->thePreference->extra_conscient,
                'extra_duration' => $data->thePreference->extra_duration,
                'extra_TOD' => $data->thePreference->extra_TOD,
                'open_agree' => $data->thePreference->open_agree,
                'open_conscient' => $data->thePreference->open_conscient,
                'open_duration' => $data->thePreference->open_duration,
                'open_TOD' => $data->thePreference->open_TOD,
                'agree_conscient' => $data->thePreference->agree_conscient,
                'agree_duration' => $data->thePreference->agree_duration,
                'agree_TOD' => $data->thePreference->agree_TOD,
                'conscient_duration' => $data->thePreference->conscient_duration,
                'conscient_TOD' => $data->thePreference->conscient_TOD,
                'duration_TOD' => $data->thePreference->duration_TOD,
            ];
        }

        if ($data->theCharacteristic == null) {
            $this->char = [
                'neuro' => null,
                'extra' => null,
                'open' => null,
                'agree' => null,
                'conscient' => null
            ];
        } else {
            $this->char = [
                'neuro' => $data->theCharacteristic->neuroticism,
                'extra' => $data->theCharacteristic->extraversion,
                'open' => $data->theCharacteristic->openness,
                'agree' => $data->theCharacteristic->agreeableness,
                'conscient' => $data->theCharacteristic->conscientiousness
            ];
        }

        // dd($data->theRecommendation);

        if ($data->theRecommendation == null) {
        } else {
            $this->recommendation = $data->theRecommendation;
        }

        $this->name = $data->userData->name;
        $this->address = $data->address;
        $this->eduLevel = $data->edu_level;
        $this->eduStatus = $data->edu_status;
        $this->eduSite = $data->edu_site;
        $this->workSite = $data->work_site;
        $this->workTitle = $data->work_title;
        $this->whatsapp = $data->userData->mobile_number;
        $this->photo = $data->userData->profile_photo_path;
        $this->registeredAt = $data->userData->created_at;
        $this->lastLoginAt = $data->userData->last_login_at;
        $this->lastActiveAt = $data->userData->last_active_at;
        $this->birthday = $data->userData->birthday;
        $this->nextAnniversary = $data->userData->nextAnniversary;
        $this->status = $data->userData->exist_status;
        $this->hasGuardian = $data->has_guardian;
        if ($this->hasGuardian == true) {
            $this->guardian = $data->theGuardian;
            $this->guardianName = $data->theGuardian->userData->name;
            $this->guardianWhatsapp = $data->theGuardian->userData->mobile_number;
        }

        // $words = preg_split("/\s+/", $this->name);
        // $this->acronym = '';
        // $this->acronymPlus = '';
        // foreach ($words as $w) {
        //     $this->acronym .= mb_substr($w, 0, 1);
        //     $this->acronymPlus .= mb_substr($w, 0, 1) . '+';
        // }

        if ($this->photo == '') {
            $this->photoUrl = 'https://ui-avatars.com/api/?size=512&length=2&name=' . $this->data->userData->theAcronym() . '&color=7F9CF5&background=EBF4FF';
        } else {
            $this->photoUrl = asset($this->photo);
        }
    }

    public function saveChar()
    {
        // dd($this);
        $charP = StudentCharacteristic::updateOrCreate(
            [
                'student_id' => $this->data->id,
            ],
            [
                'neuroticism' => $this->char['neuro'],
                'openness' => $this->char['open'],
                'agreeableness' => $this->char['agree'],
                'extraversion' => $this->char['extra'],
                'conscientiousness' => $this->char['conscient'],
            ]
        );

        $prefP = StudentPreferences::updateOrCreate(
            [
                'student_id' => $this->data->id,
            ],
            [
                'duration' => $this->preference['duration'],
                'time_of_day' => $this->preference['time_of_day'],
                'extra_open' => $this->preference['extra_open'],
                'extra_agree' => $this->preference['extra_agree'],
                'extra_conscient' => $this->preference['extra_conscient'],
                'extra_duration' => $this->preference['extra_duration'],
                'extra_TOD' => $this->preference['extra_TOD'],
                'open_agree' => $this->preference['open_agree'],
                'open_conscient' => $this->preference['open_conscient'],
                'open_duration' => $this->preference['open_duration'],
                'open_TOD' => $this->preference['open_TOD'],
                'agree_conscient' => $this->preference['agree_conscient'],
                'agree_duration' => $this->preference['agree_duration'],
                'agree_TOD' => $this->preference['agree_TOD'],
                'conscient_duration' => $this->preference['conscient_duration'],
                'conscient_TOD' => $this->preference['conscient_TOD'],
                'duration_TOD' => $this->preference['duration_TOD'],
            ]
        );
    }

    public function getRecommendation()
    {
        // dd($this->preference);

        $source = [
            [1, $this->preference['extra_open'], $this->preference['extra_agree'], $this->preference['extra_conscient'], $this->preference['extra_duration'], $this->preference['extra_TOD']],
            [1 / $this->preference['extra_open'], 1, $this->preference['open_agree'], $this->preference['open_conscient'], $this->preference['open_duration'], $this->preference['open_TOD']],
            [1 / $this->preference['extra_agree'], 1 / $this->preference['open_agree'], 1, $this->preference['agree_conscient'], $this->preference['agree_duration'], $this->preference['agree_TOD']],
            [1 / $this->preference['extra_conscient'], 1 / $this->preference['open_conscient'], 1 / $this->preference['agree_conscient'], 1, $this->preference['conscient_duration'], $this->preference['conscient_TOD']],
            [1 / $this->preference['extra_duration'], 1 / $this->preference['open_duration'], 1 / $this->preference['agree_duration'], 1 / $this->preference['conscient_duration'], 1, $this->preference['duration_TOD']],
            [1 / $this->preference['extra_TOD'], 1 / $this->preference['open_TOD'], 1 / $this->preference['agree_TOD'], 1 / $this->preference['conscient_TOD'], 1 / $this->preference['duration_TOD'], 1],
        ];
        // dd($source);

        $sourceSum = [0, 0, 0, 0, 0, 0];
        foreach ($source as $key => $item) {
            foreach ($item as $subkey => $entry) {
                $sourceSum[$subkey] += $entry;
            }
            // dd($sourceSum);
        }

        // dd($sourceSum);

        $sourceO = [
            [1 / $sourceSum[0], ($this->preference['extra_open']) / $sourceSum[1], $this->preference['extra_agree'] / $sourceSum[2], ($this->preference['extra_conscient']) / $sourceSum[3], $this->preference['extra_duration'] / $sourceSum[4], $this->preference['extra_TOD'] / $sourceSum[5]],
            [(1 / $this->preference['extra_open']) / $sourceSum[0], 1 / $sourceSum[1], $this->preference['open_agree'] / $sourceSum[2], ($this->preference['open_conscient']) / $sourceSum[3], $this->preference['open_duration'] / $sourceSum[4], $this->preference['open_TOD'] / $sourceSum[5]],
            [(1 / $this->preference['extra_agree']) / $sourceSum[0], (1 / $this->preference['open_agree']) / $sourceSum[1], 1 / $sourceSum[2], ($this->preference['agree_conscient']) / $sourceSum[3], $this->preference['agree_duration'] / $sourceSum[4], $this->preference['agree_TOD'] / $sourceSum[5]],
            [(1 / $this->preference['extra_conscient']) / $sourceSum[0], (1 / $this->preference['open_conscient']) / $sourceSum[1], (1 / $this->preference['agree_conscient']) / $sourceSum[2], 1 / $sourceSum[3], $this->preference['conscient_duration'] / $sourceSum[4], $this->preference['conscient_TOD'] / $sourceSum[5]],
            [(1 / $this->preference['extra_duration']) / $sourceSum[0], (1 / $this->preference['open_duration']) / $sourceSum[1], (1 / $this->preference['agree_duration']) / $sourceSum[2], (1 / $this->preference['conscient_duration']) / $sourceSum[3], 1 / $sourceSum[4], $this->preference['duration_TOD'] / $sourceSum[5]],
            [(1 / $this->preference['extra_TOD']) / $sourceSum[0], (1 / $this->preference['open_TOD']) / $sourceSum[1], (1 / $this->preference['agree_TOD']) / $sourceSum[2], (1 / $this->preference['conscient_TOD']) / $sourceSum[3], (1 / $this->preference['duration_TOD']) / $sourceSum[4], 1 / $sourceSum[5]],
        ];

        // dd($sourceO);

        $sourceOSum = [0, 0, 0, 0, 0, 0];
        // dd($sourceOAvg);
        foreach ($sourceO as $key => $item) {
            foreach ($item as $subkey => $entry) {
                $sourceOSum[$key] += $entry;
            }
        }

        foreach ($sourceOSum as $item) {
            // dd($item);
            $sourceOAvgRegular[] = $item / 6;
            $sourceOAvg[][] = $item / 6;
        }
        // dd($sourceOAvg);

        $mMult = $this->multiplyMatrices($source, $sourceOAvg);
        // dd($mMult);

        foreach ($mMult as $item) {
            foreach ($item as $subItem) {
                $mMultResult[] = $subItem;
            }
        }

        // dd($mMultResult);

        foreach ($mMultResult as $key => $item) {
            $mMultResultAvg[] = $item / $sourceOAvgRegular[$key];
        }

        // dd($mMultResultAvg);
        $mMultResultAvgSum = 0;
        foreach ($mMultResultAvg as $item) {
            $mMultResultAvgSum += $item;
        }
        $RIn = 1.24;
        $n = 6;
        $t = $mMultResultAvgSum / 6;
        $CI = ($t - 6) / 5;
        $RI = $CI / $RIn;
        if ($RI > 0.1) {
            // dd ("Matriks tidak konsisten, CI = ".$CI." , RI = ".$RI);
        } elseif ($RI == 1) {
            // dd ("Matriks sangat konsisten, CI = ".$CI." , RI = ".$RI);
        } else {
            // dd ("Matriks cukup konsisten, CI = ".$CI." , RI = ".$RI);
        }
        $extra_sum = 0;
        $open_sum = 0;
        $agree_sum = 0;
        $conscient_sum = 0;
        $duration_sum = 0;
        $TOD_sum = 0;
        foreach (Tutor::with('userData', 'thePreference', 'theCharacteristic')->get() as $key => $tutor) {
            $extra_sum += abs($this->char['extra'] - $tutor->theCharacteristic->extraversion);
            $open_sum += abs($this->char['open'] - $tutor->theCharacteristic->openness);
            $agree_sum += abs($this->char['agree'] - $tutor->theCharacteristic->agreeableness);
            $conscient_sum += abs($this->char['conscient'] - $tutor->theCharacteristic->conscientiousness);
            $duration_sum += abs($this->preference['duration'] - $tutor->thePreference->duration) + 1;
            $TOD_sum += abs($this->preference['time_of_day'] - $tutor->thePreference->time_of_day) + 1;

            $tutorList[] = [
                'id' => $tutor->id,
                'name' => $tutor->userData->name,
                'extra_diff' => abs($this->char['extra'] - $tutor->theCharacteristic->extraversion),
                'open_diff' => abs($this->char['open'] - $tutor->theCharacteristic->openness),
                'agree_diff' => abs($this->char['agree'] - $tutor->theCharacteristic->agreeableness),
                'conscient_diff' => abs($this->char['conscient'] - $tutor->theCharacteristic->conscientiousness),
                'duration_diff' => abs($this->preference['duration'] - $tutor->thePreference->duration) + 1,
                'TOD_diff' => abs($this->preference['time_of_day'] - $tutor->thePreference->time_of_day) + 1,
            ];
        }

        $tutorList['sum'] = [
            'extra_sum' => $extra_sum,
            'open_sum' => $open_sum,
            'agree_sum' => $agree_sum,
            'conscient_sum' => $conscient_sum,
            'duration_sum' => $duration_sum,
            'TOD_sum' => $TOD_sum,
        ];
        // dd($tutorList);

        foreach ($tutorList as $key => $data) {
            // dd($tutorList[$key]);
            // dd($data['extra_diff']);
            if ($key != 'sum') {
                $tutorListAvg[] = [
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'extra_diff_avg' => $data['extra_diff'] / $tutorList['sum']['extra_sum'],
                    'open_diff_avg' => $data['open_diff'] / $tutorList['sum']['open_sum'],
                    'agree_diff_avg' => $data['agree_diff'] / $tutorList['sum']['agree_sum'],
                    'conscient_diff_avg' => $data['conscient_diff'] / $tutorList['sum']['conscient_sum'],
                    'duration_diff_avg' => $data['duration_diff'] / $tutorList['sum']['duration_sum'],
                    'TOD_diff_avg' => $data['TOD_diff'] / $tutorList['sum']['TOD_sum'],
                ];
            }
        }

        // dd($tutorListAvg);
        // dd($sourceOAvg);

        foreach ($tutorListAvg as $key => $item) {
            // dd($item['extra_diff_avg']);
            // dd($sourceOAvgRegular[0]);
            $extra_mul = $item['extra_diff_avg'] * $sourceOAvgRegular[0];
            $open_mul = $item['open_diff_avg'] * $sourceOAvgRegular[1];
            $agree_mul = $item['agree_diff_avg'] * $sourceOAvgRegular[2];
            $conscient_mul = $item['conscient_diff_avg'] * $sourceOAvgRegular[3];
            $duration_mul = $item['duration_diff_avg'] * $sourceOAvgRegular[4];
            $TOD_mul = $item['TOD_diff_avg'] * $sourceOAvgRegular[5];
            $result[] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'extra_mul' => $extra_mul,
                'open_mul' => $open_mul,
                'agree_mul' => $agree_mul,
                'conscient_mul' => $conscient_mul,
                'duration_mul' => $duration_mul,
                'TOD_mul' => $TOD_mul,
                'sum' => $extra_mul + $open_mul + $agree_mul + $conscient_mul + $duration_mul + $TOD_mul,
            ];

            // $result[$key] = [
            //     'id' => $item['id'],
            //     'name' => $item['name'],
            // ];
            // $extra_diff_avg = $item['extra_diff_avg'];
            // foreach ($item as $subKey => $subItem) {
            //     if ($subKey == 'id' || $subKey == 'name') {
            //         continue;
            //     }
            //     // dd($item);
            //     // dd($item['extra_diff_avg']);
            //     $result[$key][] = [
            //         'extra_mul' => $extra_diff_avg * $sourceOAvgRegular[$subKey],
            //     ];
            // }
        }

        // dd($result);

        $key_values = array_column($result, 'sum');
        array_multisort($key_values, SORT_ASC, $result);

        // dd($result);
        $time = now();
        foreach ($result as $item) {
            $toSave[] = [
                'tutor_id' => $item['id'],
                'student_id' => $this->data->id,
                'point' => $item['sum'],
                'created_at' => $time,
                'updated_at' => $time,
            ];
        }
        Recommendation::insert($toSave);
    }


    function multiplyMatrices($matrix1, $matrix2)
    {
        $rows1 = count($matrix1);
        $cols1 = count($matrix1[0]);
        $cols2 = count($matrix2[0]);

        if ($cols1 != count($matrix2)) {
            return "Matrices cannot be multiplied. Number of 
                    columns in the first matrix must be equal to 
                    the number of rows in the second matrix.";
        }

        $result = array_fill(0, $rows1, array_fill(0, $cols2, 0));

        for ($i = 0; $i < $rows1; $i++) {
            for ($j = 0; $j < $cols2; $j++) {
                for ($k = 0; $k < $cols1; $k++) {
                    $result[$i][$j] += $matrix1[$i][$k] * $matrix2[$k][$j];
                }
            }
        }

        return $result;
    }


    public function render()
    {
        $data = Student::with('userData', 'thePreference', 'theCharacteristic', 'theRecommendation.theTutor.userData')->where('nim', $this->data->nim)->firstOrFail();
        // dd($data);
        $this->data = $data;
        if ($data->thePreference == null) {
            $this->preference = [
                'duration' => null,
                'time_of_day' => null,
                'extra_open' => null,
                'extra_agree' => null,
                'extra_conscient' => null,
                'extra_duration' => null,
                'extra_TOD' => null,
                'open_agree' => null,
                'open_conscient' => null,
                'open_duration' => null,
                'open_TOD' => null,
                'agree_conscient' => null,
                'agree_duration' => null,
                'agree_TOD' => null,
                'conscient_duration' => null,
                'conscient_TOD' => null,
                'duration_TOD' => null,
            ];
        } else {
            $this->preference = [
                'duration' => $data->thePreference->duration,
                'time_of_day' => $data->thePreference->time_of_day,
                'extra_open' => $data->thePreference->extra_open,
                'extra_agree' => $data->thePreference->extra_agree,
                'extra_conscient' => $data->thePreference->extra_conscient,
                'extra_duration' => $data->thePreference->extra_duration,
                'extra_TOD' => $data->thePreference->extra_TOD,
                'open_agree' => $data->thePreference->open_agree,
                'open_conscient' => $data->thePreference->open_conscient,
                'open_duration' => $data->thePreference->open_duration,
                'open_TOD' => $data->thePreference->open_TOD,
                'agree_conscient' => $data->thePreference->agree_conscient,
                'agree_duration' => $data->thePreference->agree_duration,
                'agree_TOD' => $data->thePreference->agree_TOD,
                'conscient_duration' => $data->thePreference->conscient_duration,
                'conscient_TOD' => $data->thePreference->conscient_TOD,
                'duration_TOD' => $data->thePreference->duration_TOD,
            ];
        }

        if ($data->theCharacteristic == null) {
            $this->char = [
                'neuro' => null,
                'extra' => null,
                'open' => null,
                'agree' => null,
                'conscient' => null
            ];
        } else {
            $this->char = [
                'neuro' => $data->theCharacteristic->neuroticism,
                'extra' => $data->theCharacteristic->extraversion,
                'open' => $data->theCharacteristic->openness,
                'agree' => $data->theCharacteristic->agreeableness,
                'conscient' => $data->theCharacteristic->conscientiousness
            ];
        }

        // dd($data->theRecommendation);

        if ($data->theRecommendation == null) {
        } else {
            $this->recommendation = $data->theRecommendation->sortByDesc('created_at');
            // $this->recommendation = Recommendation::where('student_id', $this->data->id)->orderBy('created_at', 'DESC')->paginate(5);
        }
        return view('livewire.student.show');
    }
}
