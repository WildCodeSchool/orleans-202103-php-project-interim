<?php

namespace App\Entity;

use App\Entity\StudyField;
use Symfony\Component\Validator\Constraints as Assert;

class FilterStudyField
{
    private ?StudyField $studyField = null;

    /**
     * @return null|StudyField
     */
    public function getStudyField(): ?StudyField
    {
        return $this->studyField;
    }

    /**
     * @return FilterStudyField
     */
    public function setStudyField(?StudyField $studyField): self
    {
        $this->studyField = $studyField;

        return $this;
    }
}
