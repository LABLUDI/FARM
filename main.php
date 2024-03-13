<?php


abstract class Animal
{
    protected int $registrationNumber;

    public function __construct(int $registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;
    }

    abstract public function collectProduct(): int;
}

class Cow extends Animal
{
    public function collectProduct(): int
    {
        return rand(8, 12); // Сбор молока
    }
}

class Chicken extends Animal
{
    public function collectProduct(): int
    {
        return rand(0, 1); // Сбор яиц
    }
}

class Farm
{
    private array $animals = [];

    public function addAnimal(Animal $animal): void
    {
        $this->animals[] = $animal;
    }

    public function countAnimals(): array
    {
        $cowCount = 0;
        $chickenCount = 0;

        foreach ($this->animals as $animal) {
            if ($animal instanceof Cow) {
                $cowCount++;
            } elseif ($animal instanceof Chicken) {
                $chickenCount++;
            }
        }

        return ['cows' => $cowCount, 'chickens' => $chickenCount];
    }

    public function collectProducts(): array
    {
        $milkTotal = 0;
        $eggsTotal = 0;

        foreach ($this->animals as $animal) {
            if ($animal instanceof Cow) {
                $milkTotal += $animal->collectProduct();
            } elseif ($animal instanceof Chicken) {
                $eggsTotal += $animal->collectProduct();
            }
        }

        return ['milk' => $milkTotal, 'eggs' => $eggsTotal];
    }
}

// Создаем ферму
$farm = new Farm();

// Добавляем животных на ферму
for ($i = 1; $i <= 10; $i++) {
    $cow = new Cow($i);
    $farm->addAnimal($cow);
}

for ($i = 1; $i <= 20; $i++) {
    $chicken = new Chicken($i);
    $farm->addAnimal($chicken);
}

// Выводим информацию о количестве животных на ферме
$animalCounts = $farm->countAnimals();
echo "Коров на ферме: {$animalCounts['cows']}\n";
echo "Кур на ферме: {$animalCounts['chickens']}\n";

// Проводим сбор продукции
$productCounts = $farm->collectProducts();
echo "Собрано молока: {$productCounts['milk']} литров\n";
echo "Собрано яиц: {$productCounts['eggs']} штук\n";

// Добавляем новых животных на ферму
for ($i = 1; $i <= 5; $i++) {
    $chicken = new Chicken($i);
    $farm->addAnimal($chicken);
}

$cow = new Cow(11);
$farm->addAnimal($cow);

// Выводим информацию о количестве животных на ферме
$animalCounts = $farm->countAnimals();
echo "Коров на ферме: {$animalCounts['cows']}\n";
echo "Кур на ферме: {$animalCounts['chickens']}\n";

// Проводим сбор продукции еще раз
$productCounts = $farm->collectProducts();
echo "Собрано молока: {$productCounts['milk']} литров\n";
echo "Собрано яиц: {$productCounts['eggs']} штук\n";
