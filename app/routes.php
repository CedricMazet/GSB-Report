<?php

use Symfony\Component\HttpFoundation\Request;

// Home page
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
});
//--------------------------------------------------------------------------------------------------------------------------
// Details for a drug
$app->get('/drugs/{id}', function($id) use ($app) {
    $drug = $app['dao.drug']->find($id);
    return $app['twig']->render('drug.html.twig', array('drug' => $drug));
});

// List of all drugs
$app->get('/drugs/', function() use ($app) {
    $drugs = $app['dao.drug']->findAll();
    return $app['twig']->render('drugs.html.twig', array('drugs' => $drugs));
});

// Search form for drugs
$app->get('/drugs/search/', function() use ($app) {
    $families = $app['dao.family']->findAll();
    return $app['twig']->render('drugs_search.html.twig', array('families' => $families));
});

// Results page for drugs
$app->post('/drugs/results/', function(Request $request) use ($app) {
    $familyId = $request->request->get('family');
    $drugs = $app['dao.drug']->findAllByFamily($familyId);
    return $app['twig']->render('drugs_results.html.twig', array('drugs' => $drugs));
});
//---------------------------------------------------------------------------------------------------------------------------
// Details for a Practitioner
$app->get('/Practitioners/{id}', function($id) use ($app) {
    $practitioner = $app['dao.practitioner']->find($id);
    return $app['twig']->render('practitioner.html.twig', array('practitioner' => $practitioner));
});

// List of all Practitioners
$app->get('/Practitioners/', function() use ($app) {
    $practitioners = $app['dao.practitioner']->findAll();
    return $app['twig']->render('practitioners.html.twig', array('practitioners' => $practitioners));
});

// Search form for Practitioners
$app->get('/practitioners/search/', function() use ($app) {
    $practitioner_types = $app['dao.practitioner_type']->findAll();
    return $app['twig']->render('practitioners_search.html.twig', array('practitioner_types' => $practitioner_types));
});

// Results page for Practitioners
$app->post('/practitioners/results/', function(Request $request) use ($app) {
    $practitioner_typeId = $request->request->get('practitioner_type');
    $practitioners = $app['dao.practitioner']->findAllByFamily($familyId);
    return $app['twig']->render('practitioners_results.html.twig', array('practitioners' => $practitioners));
});
