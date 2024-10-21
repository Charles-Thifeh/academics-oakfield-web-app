@php
    $class = $data['class'];
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

    $comb = array();

    $comb = add_combined($comp->mt ?? null, $comb);
    $comb = add_combined($bs->mt ?? null, $comb);
    $comb = add_combined($bt->mt ?? null, $comb);
    $comb = add_combined($phe->mt ?? null, $comb);
    $bst_mt = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($comp->ca ?? null, $comb);
    $comb = add_combined($bs->ca ?? null, $comb);
    $comb = add_combined($bt->ca ?? null, $comb);
    $comb = add_combined($phe->ca ?? null, $comb);
    $bst_ca = round(average($comb), 1);
    $comb = array();


    $comb = add_combined($comp->ex ?? null, $comb);
    $comb = add_combined($bs->ex ?? null, $comb);
    $comb = add_combined($bt->ex ?? null, $comb);
    $comb = add_combined($phe->ex ?? null, $comb);
    $bst_ex = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($comp->ts ?? null, $comb);
    $comb = add_combined($bs->ts ?? null, $comb);
    $comb = add_combined($bt->ts ?? null, $comb);
    $comb = add_combined($phe->ts ?? null, $comb);
    $bst_ts = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($compf->ts ?? null, $comb);
    $comb = add_combined($bsf->ts ?? null, $comb);
    $comb = add_combined($btf->ts ?? null, $comb);
    $comb = add_combined($phef->ts ?? null, $comb);
    $bstf_ts = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($comps->ts ?? null, $comb);
    $comb = add_combined($bss->ts ?? null, $comb);
    $comb = add_combined($bts->ts ?? null, $comb);
    $comb = add_combined($phes->ts ?? null, $comb);
    $bsts_ts = round(average($comb), 1);
    $comb = array();

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

    $comb = add_combined($cca->mt ?? null, $comb);
    $comb = add_combined($mus->mt ?? null, $comb);
    $cc_mt = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($cca->ca ?? null, $comb);
    $comb = add_combined($mus->ca ?? null, $comb);
    $cc_ca = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($cca->ex ?? null, $comb);
    $comb = add_combined($mus->ex ?? null, $comb);
    $cc_ex = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($cca->ts ?? null, $comb);
    $comb = add_combined($mus->ts ?? null, $comb);
    $cc_ts = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($ccaf->ts ?? null, $comb);
    $comb = add_combined($musf->ts ?? null, $comb);
    $ccf_ts = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($ccas->ts ?? null, $comb);
    $comb = add_combined($muss->ts ?? null, $comb);
    $ccf_ts = round(average($comb), 1);
    $comb = array();

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

    $comb = add_combined($civ->mt ?? null, $comb);
    $comb = add_combined($ss->mt ?? null, $comb);
    $nve_mt = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($civ->ca ?? null, $comb);
    $comb = add_combined($ss->ca ?? null, $comb);
    $nve_ca = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($civ->ex ?? null, $comb);
    $comb = add_combined($ss->ex ?? null, $comb);
    $nve_ex = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($civ->ts ?? null, $comb);
    $comb = add_combined($ss->ts ?? null, $comb);
    $nve_ts = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($civf->ts ?? null, $comb);
    $comb = add_combined($ssf->ts ?? null, $comb);
    $nvef_ts = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($civs->ts ?? null, $comb);
    $comb = add_combined($sss->ts ?? null, $comb);
    $nves_ts = round(average($comb), 1);
    $comb = array();

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

    $comb = add_combined($agr->mt ?? null, $comb);
    $comb = add_combined($he->mt ?? null, $comb);
    $pvs_mt = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($agr->ca ?? null, $comb);
    $comb = add_combined($he->ca ?? null, $comb);
    $pvs_ca = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($agr->ex ?? null, $comb);
    $comb = add_combined($he->ex ?? null, $comb);
    $pvs_ex = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($agr->ts ?? null, $comb);
    $comb = add_combined($he->ts ?? null, $comb);
    $pvs_ts = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($agrf->ts ?? null, $comb);
    $comb = add_combined($hef->ts ?? null, $comb);
    $pvsf_ts = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($agrs->ts ?? null, $comb);
    $comb = add_combined($hes->ts ?? null, $comb);
    $pvss_ts = round(average($comb), 1);
    $comb = array();

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

    $comb = add_combined($eng->mt ?? null, $comb);
    $comb = add_combined($lit->mt ?? null, $comb);
    $eng_mt = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($eng->ca ?? null, $comb);
    $comb = add_combined($lit->ca ?? null, $comb);
    $eng_ca = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($eng->ex ?? null, $comb);
    $comb = add_combined($lit->ex ?? null, $comb);
    $eng_ex = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($eng->ts ?? null, $comb);
    $comb = add_combined($lit->ts ?? null, $comb);
    $eng_ts = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($engf->ts ?? null, $comb);
    $comb = add_combined($litf->ts ?? null, $comb);
    $engf_ts = round(average($comb), 1);
    $comb = array();

    $comb = add_combined($engs->ts ?? null, $comb);
    $comb = add_combined($lits->ts ?? null, $comb);
    $engs_ts = round(average($comb), 1);
    $comb = array();

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
@endphp

@include('result-checker.jss.third.result')
