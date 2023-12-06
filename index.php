

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Робота з массивами</title>
</head>
<body>

<form method="post" action="">
    <label for="array1">Масив 1:</label>
    <input type="text" name="array1" id="array1" placeholder="Введіть масив через кому" value="2,4,5,5,55,2,1,1" required>
    <br>
    <label for="array2">Масив 2:</label>
    <input type="text" name="array2" id="array2" placeholder="Введіть масив через кому" value="2,4,5,5,2,6,5,2" required>
    <br>
    <label for="operation">Виберіть операцію:</label>
    <select name="operation" id="operation">
        <option value="unique">Прибрати дублюючі</option>
        <option value="count_duplicates">Кількість дублюючих елементів</option>
        <option value="merge">Злиття без дублікатів</option>
        <option value="reverse">Зміна місцями значень</option>
    </select>
    <br>
    <input type="submit" name="submit" value="Виконати операцію">
</form>

</body>
</html>

<?php

function processForm() {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $input1 = isset($_POST['array1']) ? $_POST['array1'] : '';
        $input2 = isset($_POST['array2']) ? $_POST['array2'] : '';

        $array1 = explode(',', $input1);
        $array2 = explode(',', $input2);

        $operation = isset($_POST['operation']) ? $_POST['operation'] : '';
        if (isset($array1)) {
            echo "Вхідні данні Масив 1: " . implode(', ', $array1) . "<br>";
        }

        if (isset($array2)) {
            echo "Вхідні данні Масив 2:  " . implode(', ', $array2) . "<br>";
        }

        switch ($operation) {
            case 'unique':
                $array1 = array_unique($array1);
                $array2 = array_unique($array2);
                if (isset($array1)) {
                    echo "Масив 1 без дублікатів: " . implode(', ', $array1) . "<br>";
                }
                if (isset($array2)) {
                    echo "Масив 2 без дублікатів: " . implode(', ', $array2) . "<br>";
                }
                break;
            case 'count_duplicates':
                $duplicatesCount = count(array_intersect($array1, $array2));
                echo "Кількість дублюючих елементів: $duplicatesCount<br>";
                break;

            case 'merge':
                $mergedArray = array_merge(array_diff($array1, $array2), $array2);
                $mergedArray = array_unique($mergedArray);
                if (isset($mergedArray)) {
                    echo "Злитий масив з унікальними значеннями: " . implode(', ', $mergedArray) . "<br>";
                }
                break;

            case 'reverse':
                $array1 = reverseArray($array1);
                $array2 = reverseArray($array2);
                if (isset($array1)) {
                    echo "Масив 1 перевернутий: " . implode(', ', $array1) . "<br>";
                }

                if (isset($array2)) {
                    echo "Масив 2 перевернутий: " . implode(', ', $array2) . "<br>";
                }
                break;
            default:
                break;
        }
    }
}

function reverseArray($inputArray) {
    $reversedArray = [];

    if (!empty($inputArray)) {
        foreach ($inputArray as $value) {
            array_unshift($reversedArray, $value);
        }
    }

    return $reversedArray;
}

processForm();

?>