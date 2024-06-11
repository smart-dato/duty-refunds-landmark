<?php

namespace SmartDato\DutyRefundsLandmark\Enums;

enum LabelEncoding: string
{
    case LINKS = 'LINKS'; //  (Default) returns links to all labels which must be retrieved in tag.
    case BASE64 = 'BASE64'; // Base64 encoded label image is returned directly in the response in tag.
    case BASE64COMPRESSED = 'BASE64COMPRESSED'; // GZcompressed and Base64 encoded label image is returned directly in the response in tag.

}
