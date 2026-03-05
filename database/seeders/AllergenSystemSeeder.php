<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Allergen;
use App\Models\Product;
use App\Models\Contact;
use App\Models\Supplier;
use App\Models\ProductPerAllergen;
use App\Models\ProductPerSupplier;
use App\Models\Magazine;
use Illuminate\Support\Facades\DB;

class AllergenSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks for seeding
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Clear existing data and reset auto-increments
        ProductPerSupplier::truncate();
        ProductPerAllergen::truncate();
        Magazine::truncate();
        Supplier::truncate();
        Contact::truncate();
        Product::truncate();
        Allergen::truncate();

        // Seed Allergens
        Allergen::create(['naam' => 'Gluten', 'omschrijving' => 'Dit product bevat gluten']);
        Allergen::create(['naam' => 'Gelatine', 'omschrijving' => 'Dit product bevat gelatine']);
        Allergen::create(['naam' => 'AZO-Kleurstof', 'omschrijving' => 'Dit product bevat AZO-kleurstoffen']);
        Allergen::create(['naam' => 'Lactose', 'omschrijving' => 'Dit product bevat lactose']);
        Allergen::create(['naam' => 'Soja', 'omschrijving' => 'Dit product bevat soja']);

        // Seed Products
        Product::create(['naam' => 'Mintnopjes', 'barcode' => '8719587231278']);
        Product::create(['naam' => 'Schoolkrijt', 'barcode' => '8719587326713']);
        Product::create(['naam' => 'Honingdrop', 'barcode' => '8719587327836']);
        Product::create(['naam' => 'Zure Beren', 'barcode' => '8719587321441']);
        Product::create(['naam' => 'Cola Flesjes', 'barcode' => '8719587321237']);
        Product::create(['naam' => 'Turtles', 'barcode' => '8719587322245']);
        Product::create(['naam' => 'Witte Muizen', 'barcode' => '8719587328256']);
        Product::create(['naam' => 'Reuzen Slangen', 'barcode' => '8719587325641']);
        Product::create(['naam' => 'Zoute Rijen', 'barcode' => '8719587322739']);
        Product::create(['naam' => 'Winegums', 'barcode' => '8719587327527']);
        Product::create(['naam' => 'Drop Munten', 'barcode' => '8719587322345']);
        Product::create(['naam' => 'Kruis Drop', 'barcode' => '8719587322265']);
        Product::create(['naam' => 'Zoute Ruitjes', 'barcode' => '8719587323256']);
        Product::create(['naam' => 'Drop ninja\'s', 'barcode' => '8719587323277']);

        // Seed Contacts
        Contact::create(['straat' => 'Van Gilslaan', 'huisnummer' => '34', 'postcode' => '1045CB', 'stad' => 'Hilvarenbeek']);
        Contact::create(['straat' => 'Den Dolderpad', 'huisnummer' => '2', 'postcode' => '1067RC', 'stad' => 'Utrecht']);
        Contact::create(['straat' => 'Fredo Raalteweg', 'huisnummer' => '257', 'postcode' => '1236OP', 'stad' => 'Nijmegen']);
        Contact::create(['straat' => 'Bertrand Russellhof', 'huisnummer' => '21', 'postcode' => '2034AP', 'stad' => 'Den Haag']);
        Contact::create(['straat' => 'Leon van Bonstraat', 'huisnummer' => '213', 'postcode' => '145XC', 'stad' => 'Lunteren']);
        Contact::create(['straat' => 'Bea van Lingenlaan', 'huisnummer' => '234', 'postcode' => '2197FG', 'stad' => 'Sint Pancras']);

        // Seed Suppliers
        Supplier::create(['naam' => 'Venco', 'contact_persoon' => 'Bert van Linge', 'leverancier_nummer' => 'L1029384719', 'mobiel' => '06-28493827', 'contact_id' => 1]);
        Supplier::create(['naam' => 'Astra Sweets', 'contact_persoon' => 'Jasper del Monte', 'leverancier_nummer' => 'L1029284315', 'mobiel' => '06-39398734', 'contact_id' => 2]);
        Supplier::create(['naam' => 'Haribo', 'contact_persoon' => 'Sven Stalman', 'leverancier_nummer' => 'L1029324748', 'mobiel' => '06-24383291', 'contact_id' => 3]);
        Supplier::create(['naam' => 'Basset', 'contact_persoon' => 'Joyce Stelterberg', 'leverancier_nummer' => 'L1023845773', 'mobiel' => '06-48293823', 'contact_id' => 4]);
        Supplier::create(['naam' => 'De Bron', 'contact_persoon' => 'Remco Veenstra', 'leverancier_nummer' => 'L1023857736', 'mobiel' => '06-34291234', 'contact_id' => 5]);
        Supplier::create(['naam' => 'Quality Street', 'contact_persoon' => 'Johan Nooij', 'leverancier_nummer' => 'L1029234586', 'mobiel' => '06-23458456', 'contact_id' => 6]);
        Supplier::create(['naam' => 'Hom Ken Food', 'contact_persoon' => 'Hom Ken', 'leverancier_nummer' => 'L1029234599', 'mobiel' => '06-23458477', 'contact_id' => null]);

        // Seed Magazine
        Magazine::create(['product_id' => 1, 'verpakkings_eenheid' => '5', 'aantal_aanwezig' => 453]);
        Magazine::create(['product_id' => 2, 'verpakkings_eenheid' => '2,5', 'aantal_aanwezig' => 400]);
        Magazine::create(['product_id' => 3, 'verpakkings_eenheid' => '5', 'aantal_aanwezig' => 1]);
        Magazine::create(['product_id' => 4, 'verpakkings_eenheid' => '1', 'aantal_aanwezig' => 800]);
        Magazine::create(['product_id' => 5, 'verpakkings_eenheid' => '3', 'aantal_aanwezig' => 234]);
        Magazine::create(['product_id' => 6, 'verpakkings_eenheid' => '2', 'aantal_aanwezig' => 345]);
        Magazine::create(['product_id' => 7, 'verpakkings_eenheid' => '1', 'aantal_aanwezig' => 795]);
        Magazine::create(['product_id' => 8, 'verpakkings_eenheid' => '10', 'aantal_aanwezig' => 233]);
        Magazine::create(['product_id' => 9, 'verpakkings_eenheid' => '2,5', 'aantal_aanwezig' => 123]);
        Magazine::create(['product_id' => 10, 'verpakkings_eenheid' => '3', 'aantal_aanwezig' => null]);
        Magazine::create(['product_id' => 11, 'verpakkings_eenheid' => '2', 'aantal_aanwezig' => 367]);
        Magazine::create(['product_id' => 12, 'verpakkings_eenheid' => '1', 'aantal_aanwezig' => 467]);
        Magazine::create(['product_id' => 13, 'verpakkings_eenheid' => '5', 'aantal_aanwezig' => 20]);

        // Seed ProductPerAllergen
        ProductPerAllergen::create(['product_id' => 1, 'allergen_id' => 2]);
        ProductPerAllergen::create(['product_id' => 1, 'allergen_id' => 1]);
        ProductPerAllergen::create(['product_id' => 1, 'allergen_id' => 3]);
        ProductPerAllergen::create(['product_id' => 3, 'allergen_id' => 4]);
        ProductPerAllergen::create(['product_id' => 6, 'allergen_id' => 5]);
        ProductPerAllergen::create(['product_id' => 9, 'allergen_id' => 2]);
        ProductPerAllergen::create(['product_id' => 9, 'allergen_id' => 5]);
        ProductPerAllergen::create(['product_id' => 10, 'allergen_id' => 2]);
        ProductPerAllergen::create(['product_id' => 12, 'allergen_id' => 4]);
        ProductPerAllergen::create(['product_id' => 13, 'allergen_id' => 1]);
        ProductPerAllergen::create(['product_id' => 13, 'allergen_id' => 4]);
        ProductPerAllergen::create(['product_id' => 13, 'allergen_id' => 5]);
        ProductPerAllergen::create(['product_id' => 14, 'allergen_id' => 5]);

        // Seed ProductPerSupplier
        ProductPerSupplier::create(['supplier_id' => 1, 'product_id' => 1, 'datum_levering' => '2023-04-09', 'aantal' => 23, 'datum_eerst_volgende_levering' => '2023-04-16']);
        ProductPerSupplier::create(['supplier_id' => 1, 'product_id' => 1, 'datum_levering' => '2023-04-18', 'aantal' => 21, 'datum_eerst_volgende_levering' => '2023-04-25']);
        ProductPerSupplier::create(['supplier_id' => 1, 'product_id' => 2, 'datum_levering' => '2023-04-09', 'aantal' => 12, 'datum_eerst_volgende_levering' => '2023-04-16']);
        ProductPerSupplier::create(['supplier_id' => 1, 'product_id' => 3, 'datum_levering' => '2023-04-10', 'aantal' => 11, 'datum_eerst_volgende_levering' => '2023-04-17']);
        ProductPerSupplier::create(['supplier_id' => 2, 'product_id' => 4, 'datum_levering' => '2023-04-14', 'aantal' => 16, 'datum_eerst_volgende_levering' => '2023-04-21']);
        ProductPerSupplier::create(['supplier_id' => 2, 'product_id' => 4, 'datum_levering' => '2023-04-21', 'aantal' => 23, 'datum_eerst_volgende_levering' => '2023-04-28']);
        ProductPerSupplier::create(['supplier_id' => 2, 'product_id' => 5, 'datum_levering' => '2023-04-14', 'aantal' => 45, 'datum_eerst_volgende_levering' => '2023-04-21']);
        ProductPerSupplier::create(['supplier_id' => 2, 'product_id' => 6, 'datum_levering' => '2023-04-14', 'aantal' => 30, 'datum_eerst_volgende_levering' => '2023-04-21']);
        ProductPerSupplier::create(['supplier_id' => 3, 'product_id' => 7, 'datum_levering' => '2023-04-12', 'aantal' => 12, 'datum_eerst_volgende_levering' => '2023-04-19']);
        ProductPerSupplier::create(['supplier_id' => 3, 'product_id' => 7, 'datum_levering' => '2023-04-19', 'aantal' => 23, 'datum_eerst_volgende_levering' => '2023-04-26']);
        ProductPerSupplier::create(['supplier_id' => 3, 'product_id' => 8, 'datum_levering' => '2023-04-10', 'aantal' => 12, 'datum_eerst_volgende_levering' => '2023-04-17']);
        ProductPerSupplier::create(['supplier_id' => 3, 'product_id' => 9, 'datum_levering' => '2023-04-11', 'aantal' => 1, 'datum_eerst_volgende_levering' => '2023-04-18']);
        ProductPerSupplier::create(['supplier_id' => 4, 'product_id' => 10, 'datum_levering' => '2023-04-16', 'aantal' => 24, 'datum_eerst_volgende_levering' => '2023-04-30']);
        ProductPerSupplier::create(['supplier_id' => 5, 'product_id' => 11, 'datum_levering' => '2023-04-10', 'aantal' => 47, 'datum_eerst_volgende_levering' => '2023-04-17']);
        ProductPerSupplier::create(['supplier_id' => 5, 'product_id' => 11, 'datum_levering' => '2023-04-19', 'aantal' => 60, 'datum_eerst_volgende_levering' => '2023-04-26']);
        ProductPerSupplier::create(['supplier_id' => 5, 'product_id' => 12, 'datum_levering' => '2023-04-11', 'aantal' => 45, 'datum_eerst_volgende_levering' => null]);
        ProductPerSupplier::create(['supplier_id' => 5, 'product_id' => 13, 'datum_levering' => '2023-04-12', 'aantal' => 23, 'datum_eerst_volgende_levering' => null]);
        ProductPerSupplier::create(['supplier_id' => 7, 'product_id' => 14, 'datum_levering' => '2023-04-14', 'aantal' => 20, 'datum_eerst_volgende_levering' => null]);

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
