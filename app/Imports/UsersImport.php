<?php

namespace App\Imports;

use App\excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new excel([
                'category' => $row['category'],
                'series' => $row['series'],
            ]);  
                // Delete Any Existing Role
        DB::table('excel')->where('id',$user->id)->delete();
            
        // Assign Role To User
        $user->assignRole($user->id);

        return $user;

      
    }
}
