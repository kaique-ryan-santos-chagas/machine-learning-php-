<?php 

    require_once __DIR__ . '/vendor/autoload.php';

    use Phpml\Classification\MLPClassifier;


    function searchArray($userSubject){

        global $mecatronicSubjects;
        global $informationSystemsSubjects;
        global $userSubjectsInputs;
        global $subjects;

        if(in_array($userSubject, $subjects) && in_array($userSubject, $mecatronicSubjects)){
            array_push($userSubjectsInputs, 1);
        }

        else {
            array_push($userSubjectsInputs, 0);
        }

        if(in_array($userSubject, $subjects) && in_array($userSubject, $informationSystemsSubjects)){
            array_push($userSubjectsInputs, 1);
        }

        else {
            array_push($userSubjectsInputs, 0);
        }

    }



    $mlp = new MLPClassifier(6, [3], ['Engenharia Mecatrônica', 'Sistemas de Informação']);

    $userSubjects = ['Desenvolvimento Mobile', 'Robótica', 'Circuitos Digitais'];

    $mecatronicSubjects = ['Robótica', 'Circuitos Digitais', 'Desenvolvimento Embarcado'];
    $informationSystemsSubjects = ['Desenvolvimento Web', 'Algoritmos', 'Desenvolvimento Mobile'];

    $subjects = ['Robótica', 'Circuitos Digitais', 'Desenvolvimento Embarcado', 'Desenvolvimento Web', 'Algoritmos', 'Desenvolvimento Mobile'];

    $userSubjectsInputs = [];

    array_map('searchArray', $userSubjects);

    $mlp->train(
        $samples = [[1, 1, 1, 0, 0, 0], [1, 1, 0, 0, 1, 0], [0, 0, 0, 1, 1, 1], [0, 1, 0, 1, 0, 1]],
        $targets = ['Engenharia Mecatrônica', 'Engenharia Mecatrônica', 'Sistemas de Informação', 'Sistemas de Informação'] 
    );

    $result = $mlp->predict($userSubjectsInputs);

    print_r($result);

?>