<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryGroup;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            [
                "group" => "Comics",
                "items" => [
                    "Manga",
                    "4-panel Comics"
                ]
            ],
            [
                "group" => "Illustration",
                "items" => [
                    "Illustration & CG collections",
                    "Illustrations",
                    "Tutorials",
                    "Wallpapers",
                    "3DCG",
                    "Illustration (Other)"
                ]
            ],
            [
                "group" => "Novels & Books",
                "items" => [
                    "Light Novels",
                    "Picture Books",
                    "Tech Books",
                    "Books (Other)"
                ]
            ],
            [
                "group" => "Goods",
                "items" => [
                    "Acrylic Key Chain",
                    "Key-holders & Straps",
                    "Can Badge",
                    "Badges",
                    "Stickers",
                    "Postcards",
                    "Acrylic Figure",
                    "iPhone Cases",
                    "Smartphone Cases",
                    "Body-pillow Covers",
                    "Stationery",
                    "Tapestries",
                    "Pouch",
                    "Masking Tape",
                    "Glasses & Mugs",
                    "Eyeglass cleaning cloths",
                    "Commuter pass",
                    "Towels",
                    "Mobile Batteries",
                    "Clear File Folder",
                    "Pin Badge",
                    "Posters",
                    "Blankets",
                    "Ring Grip",
                    "Acrylic Block",
                    "Acrylic Badge",
                    "Calendars",
                    "Mirrors",
                    "Cushions & Covers",
                    "Card cases",
                    "Coasters",
                    "Laminated Cards",
                    "Pen Case",
                    "Smartphone Stand",
                    "Mousepad",
                    "Puzzle",
                    "Clocks",
                    "Pillow Cover",
                    "Seal Case",
                    "Stamping Mat",
                    "Pencil Board",
                    "Umbrella",
                    "Mini Tabletop Umbrella",
                    "Goods (Other)"
                ]
            ],
            [
                "group" => "Fashion",
                "items" => [
                    "T-Shirts",
                    "Parkas",
                    "sweatshirt",
                    "Tote bags",
                    "Bags",
                    "sacoche",
                    "Hats & Caps",
                    "Tights",
                    "Fashion (Other)"
                ]
            ],
            [
                "group" => "Accessories",
                "items" => [
                    "Earrings",
                    "Necklaces",
                    "Bracelets",
                    "Hair Accessories",
                    "Brooches",
                    "Pendants",
                    "Accessories (Other)"
                ]
            ],
            [
                "group" => "Figures & Plushies & Dolls",
                "items" => [
                    "Figures",
                    "Plushies",
                    "Dolls"
                ]
            ],
            [
                "group" => "3D Models",
                "items" => [
                    "3D Characters",
                    "3D Character Attachments",
                    "3D Props",
                    "3D Environments / World",
                    "VRoid",
                    "3D Models (Other)"
                ]
            ],
            [
                "group" => "Music",
                "items" => [
                    "Music (General)",
                    "Vocaloid",
                    "Game Music",
                    "Music (Other)"
                ]
            ],
            [
                "group" => "Audio Goods",
                "items" => [
                    "Voices",
                    "Drama CDs",
                    "ASMR",
                    "Audio Goods (Other)"
                ]
            ],
            [
                "group" => "Games",
                "items" => [
                    "Computer Games",
                    "Tabletop Games",
                    "Tabletop RPG",
                    "Game-related Items"
                ]
            ],
            [
                "group" => "Software & Hardware",
                "items" => [
                    "Software",
                    "Hardware & Gadget"
                ]
            ],
            [
                "group" => "Source Materials",
                "items" => [
                    "Graphics",
                    "Graphics (3D)",
                    "Background Images",
                    "Fonts",
                    "Icons",
                    "Logos",
                    "Background Music",
                    "Sound Effects",
                    "Materials (Other)"
                ]
            ],
            [
                "group" => "Video",
                "items" => [
                    "Animation",
                    "Live-action works"
                ]
            ],
            [
                "group" => "Photographs",
                "items" => [
                    "Photos",
                    "Photobooks"
                ]
            ],
            [
                "group" => "Cosplay",
                "items" => [
                    "Cosplay Photos",
                    "Cosplay CDs",
                    "Cosplay Outfits",
                    "Cosplay Accessories",
                    "Cosplay Videos",
                    "Cosplay (Other)"
                ]
            ],
            [
                "group" => "Arts",
                "items" => [
                    "Art",
                    "Primo Art",
                    "Crafts",
                    "Sculptures, objects",
                    "Woodcuts",
                    "Folding screen",
                    "Paintings, artworks (other)"
                ]
            ]
        ];
        foreach ($groups as $group)
        {
            $categoryGroup = new CategoryGroup();
            $categoryGroup->name = $group['group'];
            $categoryGroup->save();
            foreach ($group['items'] as $item)
            {
                $category = new Category();
                $category->name = $item;
                $category
                    ->group()
                    ->associate($categoryGroup)
                    ->save();
            }
        }
    }
}
