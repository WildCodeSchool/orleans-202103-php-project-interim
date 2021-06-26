<?php

namespace App\Entity;

use App\Entity\StudyField;
use Symfony\Component\Validator\Constraints as Assert;

class FilterStudyField
{
    /**
     * @Assert\Type("App\Entity\StudyField")
     */
    private StudyField $studyField;

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
    public function setStudyField(StudyField $studyField): self
    {
        $this->studyField = $studyField;

        return $this;
    }
}
