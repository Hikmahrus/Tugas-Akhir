<?php

use Illuminate\Database\Seeder;

class MasterSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->delete();
      DB::table('kategoris')->delete();
      DB::table('bukus')->delete();
      DB::table('e_books')->delete();

          $users = [

              [
                  'name' => 'Administrator','email' => 'admin@gmail.com','password' => bcrypt('123123'),
                  'alamat' => 'tambak dalam baru 4 no 25', 'notelp' => '081232546781', 'role' => 2,
                  'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s'),
              ],
              [
                  'name' => 'Petugas','email' => 'petugas@gmail.com','password' => bcrypt('123123'),
                  'alamat' => 'tambak dalam baru 4 no 25', 'notelp' => '081232546781', 'role' => 1,
                  'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s'),
              ],
              [
                  'name' => 'User','email' => 'user@gmail.com','password' => bcrypt('123123'),
                  'alamat' => 'tambak dalam baru 4 no 25', 'notelp' => '081232546781', 'role' => 0,
                  'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s'),
              ],

          ];

          $kategori = [

              [ 'nama' => 'Horror'],
              [ 'nama' => 'Comedy'],
              [ 'nama' => 'Fantasy'],
              [ 'nama' => 'Novel'],
              [ 'nama' => 'Biografi'],
              [ 'nama' => 'Thrillers'],
              [ 'nama' => 'Adventure'],
              [ 'nama' => 'History'],
              [ 'nama' => 'Romance'],
          ];

          $buku = [

            [
                'kode' => 'A12','name' => 'Rainbow Six','img' => '1.png','penulis' => 'Tom Clancy',
                'penerbit' => 'Tom Clancy', 'thn_terbit' => '1998', 'kategori_id' => 4,
                'desc' => 'Rainbow Six adalah novel techno-thriller, yang ditulis oleh Tom Clancy dan dirilis pada 3 Agustus 1998.',
                'status' => 1,
            ],
            [
                'kode' => 'M12','name' => 'The Mist','img' => '1.png','penulis' => 'Stephen King',
                'penerbit' => 'Signet ', 'thn_terbit' => '2007', 'kategori_id' => 1,
                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'status' => 1,
            ],
            [
                'kode' => 'N12','name' => 'Journey','img' => '1.png','penulis' => 'Kathryn Lasky',
                'penerbit' => ' Scholastic Paperbacks ', 'thn_terbit' => '2003', 'kategori_id' => 3,
                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'status' => 1,
            ],
            [
                'kode' => 'B12','name' => 'Trojan Odyssey','img' => '1.png','penulis' => 'Clive Cussler',
                'penerbit' => 'Berkley Books', 'thn_terbit' => '2004', 'kategori_id' => 7,
                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'status' => 1,
            ],
            [
                'kode' => 'O12','name' => 'Warships','img' => '1.png','penulis' => 'Jacques Simmons',
                'penerbit' => 'Grosset & Dunlap', 'thn_terbit' => '1971', 'kategori_id' => 8,
                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'status' => 1,
            ],
            [
                'kode' => 'P12','name' => 'On the edge','img' => '1.png','penulis' => ' Heather Graham, Carla Neggers, Sharon Sala',
                'penerbit' => 'Mira Books', 'thn_terbit' => '2011', 'kategori_id' => 9,
                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'status' => 1,
            ],
            [
                'kode' => 'Q12','name' => 'Navigator','img' => '1.png','penulis' => 'Clive Cussler, Paul Kemprecos',
                'penerbit' => 'G.P. Putnams Sons', 'thn_terbit' => '2003', 'kategori_id' => 7,
                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'status' => 1,
            ],
            [
                'kode' => 'Q12','name' => 'Misery','img' => '1.png','penulis' => 'Stephen King',
                'penerbit' => 'Viking', 'thn_terbit' => '1987', 'kategori_id' => 1,
                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'status' => 1,
            ],
            [
                'kode' => 'Q12','name' => 'Cujo','img' => '1.png','penulis' => 'Stephen King',
                'penerbit' => 'Signet', 'thn_terbit' => '1992', 'kategori_id' => 1,
                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'status' => 1,
            ],
          ];

          $ebook = [
            [
                'kode' => 'A12','name' => 'Rainbow Six Digital Edition','img' => '1.png','penulis' => 'Tom Clancy', 'pdf' => '1.pdf',
                'penerbit' => 'Tom Clancy', 'thn_terbit' => '1998', 'kategori_id' => 4,
                'desc' => 'Rainbow Six adalah novel techno-thriller, yang ditulis oleh Tom Clancy dan dirilis pada 3 Agustus 1998.',
                'status' => 1,
            ],
          ];

          DB::table('users')->insert($users);
          DB::table('kategoris')->insert($kategori);
          DB::table('bukus')->insert($buku);
          DB::table('e_books')->insert($ebook);
    }
}
