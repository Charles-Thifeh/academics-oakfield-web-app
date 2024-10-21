@php
    $class = $data['class'];
    if($data['type'] == 'midterm'){
            $eng = DB::table('midterms')
                ->where('class', $class)
                ->where('session', $data['session'])
                ->where('term', $data['term'])
                ->where('reg_no', $result->first()->reg_no)
                ->where('subject', 'ENGLISH LANGUAGE')->first();

            $mat = DB::table('midterms')
                    ->where('class', $class)
                    ->where('session', $data['session'])
                    ->where('term', $data['term'])
                    ->where('reg_no', $result->first()->reg_no)
                    ->where('subject', 'MATHEMATICS')->first();

            $comp = DB::table('midterms')
                    ->where('class', $class)
                    ->where('session', $data['session'])
                    ->where('term', $data['term'])
                    ->where('reg_no', $result->first()->reg_no)
                    ->where('subject', 'COMPUTER SCIENCE')->first();

            $phe = DB::table('midterms')
                    ->where('class', $class)
                    ->where('session', $data['session'])
                    ->where('term', $data['term'])
                    ->where('reg_no', $result->first()->reg_no)
                    ->where('subject', 'PHE')->first();

            $bt = DB::table('midterms')
                    ->where('class', $class)
                    ->where('session', $data['session'])
                    ->where('term', $data['term'])
                    ->where('reg_no', $result->first()->reg_no)
                    ->where('subject', 'BASIC TECHNOLOGY')->first();

            $bs = DB::table('midterms')
                    ->where('class', $class)
                    ->where('session', $data['session'])
                    ->where('term', $data['term'])
                    ->where('reg_no', $result->first()->reg_no)
                    ->where('subject', 'BASIC SCIENCE')->first();

            $comb = array();

            $comb = add_combined($comp->at ?? null, $comb);
            $comb = add_combined($bs->at ?? null, $comb);
            $comb = add_combined($bt->at ?? null, $comb);
            $comb = add_combined($phe->at ?? null, $comb);
            $bst_at = average($comb);
            $comb = array();


            $comb = add_combined($comp->ex ?? null, $comb);
            $comb = add_combined($bs->ex ?? null, $comb);
            $comb = add_combined($bt->ex ?? null, $comb);
            $comb = add_combined($phe->ex ?? null, $comb);
            $bst_ex = average($comb);
            $comb = array();

            $comb = add_combined($comp->ts ?? null, $comb);
            $comb = add_combined($bs->ts ?? null, $comb);
            $comb = add_combined($bt->ts ?? null, $comb);
            $comb = add_combined($phe->ts ?? null, $comb);
            $bst_ts = average($comb);
            $comb = array();


            $cca = DB::table('midterms')
                    ->where('class', $class)
                    ->where('session', $data['session'])
                    ->where('term', $data['term'])
                    ->where('reg_no', $result->first()->reg_no)
                    ->where('subject', 'CCA')->first();

            $mus = DB::table('midterms')
                    ->where('class', $class)
                    ->where('session', $data['session'])
                    ->where('term', $data['term'])
                    ->where('reg_no', $result->first()->reg_no)
                    ->where('subject', 'MUSIC')->first();

            $comb = add_combined($cca->at ?? null, $comb);
            $comb = add_combined($mus->at ?? null, $comb);
            $cc_at = average($comb);
            $comb = array();

            $comb = add_combined($cca->ex ?? null, $comb);
            $comb = add_combined($mus->ex ?? null, $comb);
            $cc_ex = average($comb);
            $comb = array();

            $comb = add_combined($cca->ts ?? null, $comb);
            $comb = add_combined($mus->ts ?? null, $comb);
            $cc_ts = average($comb);
            $comb = array();

            $civ = DB::table('midterms')
                    ->where('class', $class)
                    ->where('session', $data['session'])
                    ->where('term', $data['term'])
                    ->where('reg_no', $result->first()->reg_no)
                    ->where('subject', 'CIVIC EDUCATION')->first();

            $ss = DB::table('midterms')
                    ->where('class', $class)
                    ->where('session', $data['session'])
                    ->where('term', $data['term'])
                    ->where('reg_no', $result->first()->reg_no)
                    ->where('subject', 'SOCIAL STUDIES')->first();

            $comb = add_combined($civ->at ?? null, $comb);
            $comb = add_combined($ss->at ?? null, $comb);
            $nve_at = average($comb);
            $comb = array();

            $comb = add_combined($civ->ex ?? null, $comb);
            $comb = add_combined($ss->ex ?? null, $comb);
            $nve_ex = average($comb);
            $comb = array();

            $comb = add_combined($civ->ts ?? null, $comb);
            $comb = add_combined($ss->ts ?? null, $comb);
            $nve_ts = average($comb);
            $comb = array();

            $agr = DB::table('midterms')
                    ->where('class', $class)
                    ->where('session', $data['session'])
                    ->where('term', $data['term'])
                    ->where('reg_no', $result->first()->reg_no)
                    ->where('subject', 'AGRICULTURAL SCIENCE')->first();

            $he = DB::table('midterms')
                    ->where('class', $class)
                    ->where('session', $data['session'])
                    ->where('term', $data['term'])
                    ->where('reg_no', $result->first()->reg_no)
                    ->where('subject', 'HOME ECONOMICS')->first();

            $comb = add_combined($agr->at ?? null, $comb);
            $comb = add_combined($he->at ?? null, $comb);
            $pvs_at = average($comb);
            $comb = array();

            $comb = add_combined($agr->ex ?? null, $comb);
            $comb = add_combined($he->ex ?? null, $comb);
            $pvs_ex = average($comb);
            $comb = array();

            $comb = add_combined($agr->ts ?? null, $comb);
            $comb = add_combined($he->ts ?? null, $comb);
            $pvs_ts = average($comb);
            $comb = array();

            $fr = DB::table('midterms')
                    ->where('class', $class)
                    ->where('session', $data['session'])
                    ->where('term', $data['term'])
                    ->where('reg_no', $result->first()->reg_no)
                    ->where('subject', 'FRENCH')->first();

            $yo = DB::table('midterms')
                    ->where('class', $class)
                    ->where('session', $data['session'])
                    ->where('term', $data['term'])
                    ->where('reg_no', $result->first()->reg_no)
                    ->where('subject', 'YORUBA')->first();

            $bus = DB::table('midterms')
                    ->where('class', $class)
                    ->where('session', $data['session'])
                    ->where('term', $data['term'])
                    ->where('reg_no', $result->first()->reg_no)
                    ->where('subject', 'BUSINESS STUDIES')->first();

            $crs = DB::table('midterms')
                    ->where('class', $class)
                    ->where('session', $data['session'])
                    ->where('term', $data['term'])
                    ->where('reg_no', $result->first()->reg_no)
                    ->where('subject', 'CRS')->first();

            $his = DB::table('midterms')
                    ->where('class', $class)
                    ->where('session', $data['session'])
                    ->where('term', $data['term'])
                    ->where('reg_no', $result->first()->reg_no)
                    ->where('subject', 'HISTORY')->first();

            $lit = DB::table('midterms')
                    ->where('class', $class)
                    ->where('session', $data['session'])
                    ->where('term', $data['term'])
                    ->where('reg_no', $result->first()->reg_no)
                    ->where('subject', 'LITERATURE')->first();

            $comb = add_combined($eng->at ?? null, $comb);
            $comb = add_combined($lit->at ?? null, $comb);
            $eng_at = average($comb);
            $comb = array();

            $comb = add_combined($eng->ex ?? null, $comb);
            $comb = add_combined($lit->ex ?? null, $comb);
            $eng_ex = average($comb);
            $comb = array();

            $comb = add_combined($eng->ts ?? null, $comb);
            $comb = add_combined($lit->ts ?? null, $comb);
            $eng_ts = average($comb);
            $comb = array();

            $dic = DB::table('midterms')
                    ->where('class', $class)
                    ->where('session', $data['session'])
                    ->where('term', $data['term'])
                    ->where('reg_no', $result->first()->reg_no)
                    ->where('subject', 'DICTION')->first();
    }
    else{
        $eng = DB::table('results')
        ->where('class', $class)
        ->where('session', $data['session'])
        ->where('term', $data['term'])
        ->where('reg_no', $result->first()->reg_no)
        ->where('subject', 'ENGLISH LANGUAGE')->first();

        $engf = DB::table('results')
        ->where('class', $class)
        ->where('session', $data['session'])
        ->where('term', 'First')
        ->where('reg_no', $result->first()->reg_no)
        ->where('subject', 'ENGLISH LANGUAGE')->first();

        $engs = DB::table('results')
        ->where('class', $class)
        ->where('session', $data['session'])
        ->where('term', 'Second')
        ->where('reg_no', $result->first()->reg_no)
        ->where('subject', 'ENGLISH LANGUAGE')->first();

        $mat = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', $data['term'])
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'MATHEMATICS')->first();

        $matf = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'First')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'MATHEMATICS')->first();

        $mats = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'Second')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'MATHEMATICS')->first();

        $comp = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', $data['term'])
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'COMPUTER SCIENCE')->first();

        $compf = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'First')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'COMPUTER SCIENCE')->first();

        $comps = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'Second')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'COMPUTER SCIENCE')->first();

        $phe = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', $data['term'])
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'PHE')->first();

        $phef = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'First')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'PHE')->first();

        $phes = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'Second')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'PHE')->first();

        $bt = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', $data['term'])
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'BASIC TECHNOLOGY')->first();

        $btf = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'First')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'BASIC TECHNOLOGY')->first();

        $bts = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'Second')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'BASIC TECHNOLOGY')->first();

        $bs = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', $data['term'])
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'BASIC SCIENCE')->first();

        $bsf = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'First')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'BASIC SCIENCE')->first();

        $bss = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'Second')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'BASIC SCIENCE')->first();

        $cca = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', $data['term'])
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'CCA')->first();

        $ccaf = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'First')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'CCA')->first();

        $ccas = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'Second')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'CCA')->first();

        $mus = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', $data['term'])
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'MUSIC')->first();

        $musf = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'First')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'MUSIC')->first();

        $muss = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'Second')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'MUSIC')->first();

        $civ = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', $data['term'])
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'CIVIC EDUCATION')->first();

        $civf = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'First')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'CIVIC EDUCATION')->first();

        $civs = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'Second')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'CIVIC EDUCATION')->first();

        $ss = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', $data['term'])
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'SOCIAL STUDIES')->first();

        $ssf = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'First')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'SOCIAL STUDIES')->first();

        $sss = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'Second')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'SOCIAL STUDIES')->first();

        $agr = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', $data['term'])
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'AGRICULTURAL SCIENCE')->first();

        $agrf = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'First')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'AGRICULTURAL SCIENCE')->first();

        $agrs = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'Second')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'AGRICULTURAL SCIENCE')->first();

        $he = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', $data['term'])
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'HOME ECONOMICS')->first();

        $hef = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'First')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'HOME ECONOMICS')->first();

        $hes = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'Second')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'HOME ECONOMICS')->first();

        $fr = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', $data['term'])
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'FRENCH')->first();

        $frf = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'First')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'FRENCH')->first();

        $frs = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'Second')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'FRENCH')->first();

        $yo = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', $data['term'])
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'YORUBA')->first();

        $bus = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', $data['term'])
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'BUSINESS STUDIES')->first();

        $crs = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', $data['term'])
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'CRS')->first();

        $his = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', $data['term'])
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'HISTORY')->first();


        $yof = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'First')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'YORUBA')->first();

        $busf = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'First')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'BUSINESS STUDIES')->first();

        $crsf = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'First')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'CRS')->first();

        $hisf = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'First')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'HISTORY')->first();

        $yos = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'Second')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'YORUBA')->first();

        $buss = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'Second')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'BUSINESS STUDIES')->first();

        $crss = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'Second')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'CRS')->first();

        $hiss = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', 'Second')
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'HISTORY')->first();

        $lit = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', $data['term'])
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'LITERATURE')->first();

        $litf = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', "First")
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'LITERATURE')->first();

        $lits = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', "Second")
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'LITERATURE')->first();

        $dic = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', $data['term'])
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'DICTION')->first();

        $dicf = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', "First")
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'DICTION')->first();

        $dics = DB::table('results')
            ->where('class', $class)
            ->where('session', $data['session'])
            ->where('term', "Second")
            ->where('reg_no', $result->first()->reg_no)
            ->where('subject', 'DICTION')->first();
    }
@endphp

@if($data['type'] == 'midterm')
    @include('result-checker.jss.midterm')
@endif
