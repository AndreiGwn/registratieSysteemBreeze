<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JaminDataSeeder extends Seeder
{
    public function run(): void
    {
        // Leveranciers
        DB::table('leveranciers')->insert([
            ['Naam' => 'Venco', 'ContactPersoon' => 'Bert van Linge', 'LeverancierNummer' => 'L1029384719', 'Mobiel' => '06-28493827'],
            ['Naam' => 'Astra Sweets', 'ContactPersoon' => 'Jasper del Monte', 'LeverancierNummer' => 'L1029284315', 'Mobiel' => '06-39398734'],
            ['Naam' => 'Haribo', 'ContactPersoon' => 'Sven Stalman', 'LeverancierNummer' => 'L1029324748', 'Mobiel' => '06-24383291'],
            ['Naam' => 'Basset', 'ContactPersoon' => 'Joyce Stelterberg', 'LeverancierNummer' => 'L1023845773', 'Mobiel' => '06-48293823'],
            ['Naam' => 'De Bron', 'ContactPersoon' => 'Remco Veenstra', 'LeverancierNummer' => 'L1023857832', 'Mobiel' => '06-34291234'],
        ]);

        // Products
        $products = [
            ['Naam' => 'Mintnopjes', 'Barcode' => '8719587231278', 'IsActief' => true],
            ['Naam' => 'Schoolkrijt', 'Barcode' => '8719587326713', 'IsActief' => true],
            ['Naam' => 'Honingdrop', 'Barcode' => '8719587327836', 'IsActief' => true],
            ['Naam' => 'Zure Beren', 'Barcode' => '8719587321441', 'IsActief' => true],
            ['Naam' => 'Cola Flesjes', 'Barcode' => '8719587321237', 'IsActief' => true],
            ['Naam' => 'Turtles', 'Barcode' => '8719587322245', 'IsActief' => true],
            ['Naam' => 'Witte Muizen', 'Barcode' => '8719587328256', 'IsActief' => true],
            ['Naam' => 'Reuzen Slangen', 'Barcode' => '8719587325641', 'IsActief' => true],
            ['Naam' => 'Zoute Rijen', 'Barcode' => '8719587322739', 'IsActief' => true],
            ['Naam' => 'Winegums', 'Barcode' => '8719587327527', 'IsActief' => false],
            ['Naam' => 'Drop Munten', 'Barcode' => '8719587322345', 'IsActief' => true],
            ['Naam' => 'Kruis Drop', 'Barcode' => '8719587322265', 'IsActief' => true],
            ['Naam' => 'Zoute Ruitjes', 'Barcode' => '8719587323256', 'IsActief' => true],
        ];
        DB::table('products')->insert($products);

        // Allergenen
        DB::table('allergenen')->insert([
            ['Naam' => 'Gluten', 'Omschrijving' => 'Dit product bevat gluten'],
            ['Naam' => 'Gelatine', 'Omschrijving' => 'Dit product bevat gelatine'],
            ['Naam' => 'AZO-Kleurstof', 'Omschrijving' => 'Dit product bevat AZO-kleurstoffen'],
            ['Naam' => 'Lactose', 'Omschrijving' => 'Dit product bevat lactose'],
            ['Naam' => 'Soja', 'Omschrijving' => 'Dit product bevat soja'],
        ]);

        // Magazijns
        DB::table('magazijns')->insert([
            ['ProductId' => 1, 'VerpakkingsEenheid' => 5, 'AantalAanwezig' => 453],
            ['ProductId' => 2, 'VerpakkingsEenheid' => 2.5, 'AantalAanwezig' => 400],
            ['ProductId' => 3, 'VerpakkingsEenheid' => 5, 'AantalAanwezig' => 1],
            ['ProductId' => 4, 'VerpakkingsEenheid' => 5, 'AantalAanwezig' => 800],
            ['ProductId' => 5, 'VerpakkingsEenheid' => 3, 'AantalAanwezig' => 234],
            ['ProductId' => 6, 'VerpakkingsEenheid' => 2, 'AantalAanwezig' => 345],
            ['ProductId' => 7, 'VerpakkingsEenheid' => 1, 'AantalAanwezig' => 795],
            ['ProductId' => 8, 'VerpakkingsEenheid' => 10, 'AantalAanwezig' => 233],
            ['ProductId' => 9, 'VerpakkingsEenheid' => 2.5, 'AantalAanwezig' => 123],
            ['ProductId' => 10, 'VerpakkingsEenheid' => 3, 'AantalAanwezig' => null],
            ['ProductId' => 11, 'VerpakkingsEenheid' => 2, 'AantalAanwezig' => 367],
            ['ProductId' => 12, 'VerpakkingsEenheid' => 1, 'AantalAanwezig' => 467],
            ['ProductId' => 13, 'VerpakkingsEenheid' => 5, 'AantalAanwezig' => 20],
        ]);

        // Product per Leveranciers
        DB::table('product_per_leveranciers')->insert([
            ['LeverancierId' => 1, 'ProductId' => 1, 'DatumLevering' => '2024-10-09', 'Aantal' => 23, 'DatumEerstVolgendeLevering' => '2024-10-16'],
            ['LeverancierId' => 1, 'ProductId' => 2, 'DatumLevering' => '2024-10-18', 'Aantal' => 21, 'DatumEerstVolgendeLevering' => '2024-10-25'],
            ['LeverancierId' => 1, 'ProductId' => 3, 'DatumLevering' => '2024-10-17', 'Aantal' => 12, 'DatumEerstVolgendeLevering' => '2024-10-24'],
            ['LeverancierId' => 2, 'ProductId' => 4, 'DatumLevering' => '2024-10-11', 'Aantal' => 11, 'DatumEerstVolgendeLevering' => '2024-10-18'],
            ['LeverancierId' => 2, 'ProductId' => 4, 'DatumLevering' => '2024-10-19', 'Aantal' => 23, 'DatumEerstVolgendeLevering' => '2024-10-26'],
            ['LeverancierId' => 2, 'ProductId' => 5, 'DatumLevering' => '2024-10-14', 'Aantal' => 45, 'DatumEerstVolgendeLevering' => '2024-10-21'],
            ['LeverancierId' => 2, 'ProductId' => 6, 'DatumLevering' => '2024-10-14', 'Aantal' => 30, 'DatumEerstVolgendeLevering' => '2024-10-21'],
            ['LeverancierId' => 3, 'ProductId' => 7, 'DatumLevering' => '2024-10-12', 'Aantal' => 12, 'DatumEerstVolgendeLevering' => '2024-10-19'],
            ['LeverancierId' => 3, 'ProductId' => 7, 'DatumLevering' => '2024-10-19', 'Aantal' => 23, 'DatumEerstVolgendeLevering' => '2024-10-26'],
            ['LeverancierId' => 3, 'ProductId' => 8, 'DatumLevering' => '2024-10-10', 'Aantal' => 12, 'DatumEerstVolgendeLevering' => '2024-10-17'],
            ['LeverancierId' => 3, 'ProductId' => 9, 'DatumLevering' => '2024-10-11', 'Aantal' => 1, 'DatumEerstVolgendeLevering' => '2024-10-18'],
            ['LeverancierId' => 4, 'ProductId' => 11, 'DatumLevering' => '2024-10-13', 'Aantal' => 15, 'DatumEerstVolgendeLevering' => '2024-10-20'],
            ['LeverancierId' => 5, 'ProductId' => 12, 'DatumLevering' => '2024-10-14', 'Aantal' => 23, 'DatumEerstVolgendeLevering' => '2024-10-21'],
            ['LeverancierId' => 5, 'ProductId' => 13, 'DatumLevering' => '2024-10-15', 'Aantal' => 12, 'DatumEerstVolgendeLevering' => '2024-10-22'],
        ]);

        // Product per Allergenen
        DB::table('product_per_allergenen')->insert([
            ['ProductId' => 1, 'AllergeenId' => 2],
            ['ProductId' => 1, 'AllergeenId' => 1],
            ['ProductId' => 1, 'AllergeenId' => 3],
            ['ProductId' => 3, 'AllergeenId' => 4],
            ['ProductId' => 6, 'AllergeenId' => 5],
            ['ProductId' => 9, 'AllergeenId' => 2],
            ['ProductId' => 9, 'AllergeenId' => 5],
            ['ProductId' => 10, 'AllergeenId' => 2],
            ['ProductId' => 12, 'AllergeenId' => 4],
            ['ProductId' => 13, 'AllergeenId' => 1],
            ['ProductId' => 13, 'AllergeenId' => 4],
            ['ProductId' => 13, 'AllergeenId' => 5],
        ]);
    }
}
