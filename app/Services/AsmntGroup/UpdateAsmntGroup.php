<?php

namespace App\Services\AsmntGroup;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\AsmntGroup;

class UpdateAsmntGroup extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $asmnt_group = AsmntGroup::where('uuid', $dto['asmnt_group_uuid'])->first();

        if (!empty($asmnt_group)) {
            $asmnt_group->update([
                'certificate_setting_id' => $dto['certificate_setting_id'],
                'name' => $dto['name'],
            ]);

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = "Assessment Group Successfully Updated";
            $this->results['data'] = $asmnt_group->toArray();
        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = "Assessment Group Not Found";
            $this->results['data'] = [];
        }


    }
}
