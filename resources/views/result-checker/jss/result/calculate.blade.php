@php
    $class = $data['class'];

    $eng = DB::table('results')
        ->where('class', $class)
        ->where('session', $data['session'])
        ->where('term', $data['term'])
        ->where('reg_no', $result->first()->reg_no)
        ->where('subject', 'ENGLISH LANGUAGE')->first();

    $mat = DB::table('results')
        ->where('class', $class)
        ->where('session', $data['session'])
        ->where('term', $data['term'])
        ->where('reg_no', $result->first()->reg_no)
        ->where('subject', 'MATHEMATICS')->first();

    $comp = DB::table('results')
        ->where('class', $class)
        ->where('session', $data['session'])
        ->where('term', $data['term'])
        ->where('reg_no', $result->first()->reg_no)
        ->where('subject', 'COMPUTER SCIENCE')->first();

    $phe = DB::table('results')
        ->where('class', $class)
        ->where('session', $data['session'])
        ->where('term', $data['term'])
        ->where('reg_no', $result->first()->reg_no)
        ->where('subject', 'PHE')->first();

    $bt = DB::table('results')
        ->where('class', $class)
        ->where('session', $data['session'])
        ->where('term', $data['term'])
        ->where('reg_no', $result->first()->reg_no)
        ->where('subject', 'BASIC TECHNOLOGY')->first();

    $bs = DB::table('results')
        ->where('class', $class)
        ->where('session', $data['session'])
        ->where('term', $data['term'])
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

    $cca = DB::table('results')
        ->where('class', $class)
        ->where('session', $data['session'])
        ->where('term', $data['term'])
        ->where('reg_no', $result->first()->reg_no)
        ->where('subject', 'CCA')->first();

    $mus = DB::table('results')
        ->where('class', $class)
        ->where('session', $data['session'])
        ->where('term', $data['term'])
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

    $civ = DB::table('results')
        ->where('class', $class)
        ->where('session', $data['session'])
        ->where('term', $data['term'])
        ->where('reg_no', $result->first()->reg_no)
        ->where('subject', 'CIVIC EDUCATION')->first();

    $ss = DB::table('results')
        ->where('class', $class)
        ->where('session', $data['session'])
        ->where('term', $data['term'])
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

    $agr = DB::table('results')
        ->where('class', $class)
        ->where('session', $data['session'])
        ->where('term', $data['term'])
        ->where('reg_no', $result->first()->reg_no)
        ->where('subject', 'AGRICULTURAL SCIENCE')->first();

    $he = DB::table('results')
        ->where('class', $class)
        ->where('session', $data['session'])
        ->where('term', $data['term'])
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

    $fr = DB::table('results')
        ->where('class', $class)
        ->where('session', $data['session'])
        ->where('term', $data['term'])
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

    $lit = DB::table('results')
        ->where('class', $class)
        ->where('session', $data['session'])
        ->where('term', $data['term'])
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

    $dic = DB::table('results')
        ->where('class', $class)
        ->where('session', $data['session'])
        ->where('term', $data['term'])
        ->where('reg_no', $result->first()->reg_no)
        ->where('subject', 'DICTION')->first();

@endphp

@include('result-checker.jss.result.result')

