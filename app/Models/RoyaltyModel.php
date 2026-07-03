<?php

namespace App\Models;

use CodeIgniter\Model;

class RoyaltyModel extends Model
{
    protected $table            = 'royalties';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['song_title', 'musician_name', 'income_source', 'plays_count', 'total_royalty', 'hash_code'];

    protected $beforeInsert     = ['generateHashHook'];
    protected $beforeUpdate     = ['generateHashHook'];

    protected function generateHashHook(array $data)
    {
        if (isset($data['data'])) {
            if (isset($data['data']['total_royalty'])) {
                $data['data']['total_royalty'] = number_format((float)$data['data']['total_royalty'], 2, '.', '');
            }

            $plainText = ($data['data']['song_title'] ?? '') . '|' . 
                         ($data['data']['musician_name'] ?? '') . '|' . 
                         ($data['data']['income_source'] ?? '') . '|' . 
                         ($data['data']['plays_count'] ?? 0) . '|' . 
                         ($data['data']['total_royalty'] ?? '0.00');

            $data['data']['hash_code'] = hash('sha256', $plainText);
        }

        return $data;
    }

    public function checkIntegrity($id)
    {
        $record = $this->find($id);
        if (!$record) return false;

        $formattedRoyalty = number_format((float)$record['total_royalty'], 2, '.', '');

        $recalculatedPlainText = $record['song_title'] . '|' . 
                                 $record['musician_name'] . '|' . 
                                 $record['income_source'] . '|' . 
                                 $record['plays_count'] . '|' . 
                                 $formattedRoyalty;

        $calculatedHash = hash('sha256', $recalculatedPlainText);

        return $calculatedHash === $record['hash_code'];
    }
}