<?php

namespace App\Services\AsmntGroup;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\AsmntGroup;

class CreateAsmntGroup extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $asmnt_group = AsmntGroup::create([
            'uuid' => $dto['uuid'],
            'certificate_setting_id' => $dto['certificate_setting_id'],
            'name' => $dto['name'],
        ]);

        $this->results['response_code'] = 200;
        $this->results['success'] = true;
        $this->results['message'] = 'Assessment Group Successfully Created';
        $this->results['data'] = $asmnt_group->toArray();
    }
}
