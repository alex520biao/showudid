<?PHP
#################################################################################
## Developed by Manifest Interactive, LLC                                      ##
## http://www.manifestinteractive.com                                          ##
## ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ ##
##                                                                             ##
## THIS SOFTWARE IS PROVIDED BY MANIFEST INTERACTIVE 'AS IS' AND ANY           ##
## EXPRESSED OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE         ##
## IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR          ##
## PURPOSE ARE DISCLAIMED.  IN NO EVENT SHALL MANIFEST INTERACTIVE BE          ##
## LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR         ##
## CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF        ##
## SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR             ##
## BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,       ##
## WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE        ##
## OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,           ##
## EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.                          ##
## ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ ##
## Author of file: Peter Schmalfeldt                                           ##
#################################################################################

/**
 * @category Apple Push Notification Service using PHP & MySQL
 * @package EasyAPNs
 * @author Peter Schmalfeldt <manifestinteractive@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link http://code.google.com/p/easyapns/
 */

/**
 * Begin Document
 */
 /*
header('Content-type: application/x-apple-aspen-config; chatset=utf-8');
header('Content-Disposition: attachment; filename="signed.mobileconfig"');
echo $mobileconfig;*/

$data = file_get_contents('php://input');
 
//file_put_contents('data.txt', $data);
//header('location:data');
$plistBegin   = '<?xml version="1.0"';
$plistEnd   = '</plist>';
 
$pos1 = strpos($data, $plistBegin);
$pos2 = strpos($data, $plistEnd);
 
$data2 = substr ($data,$pos1,$pos2-$pos1);
 
 
$xml = xml_parser_create();
 
xml_parse_into_struct($xml, $data2, $vs);
xml_parser_free($xml);
 
$UDID = "";
$CHALLENGE = "";
$DEVICE_NAME = "";
$DEVICE_PRODUCT = "";
$DEVICE_VERSION = "";
$iterator = 0;
 
$arrayCleaned = array();
 
foreach($vs as $v){
 
    if($v['level'] == 3 && $v['type'] == 'complete'){
    $arrayCleaned[]= $v;
    }
$iterator++;
}
 
$data = "";
 
$iterator = 0;
 
foreach($arrayCleaned as $elem){
                $data .= "\n==".$elem['tag']." -> ".$elem['value']."<br/>";
                switch ($elem['value']) {
                    case "CHALLENGE":
                        $CHALLENGE = $arrayCleaned[$iterator+1]['value'];
                        break;
                    case "DEVICE_NAME":
                        $DEVICE_NAME = $arrayCleaned[$iterator+1]['value'];
                        break;
                    case "PRODUCT":
                        $DEVICE_PRODUCT = $arrayCleaned[$iterator+1]['value'];
                        break;
                    case "UDID":
                        $UDID = $arrayCleaned[$iterator+1]['value'];
                        break;
                    case "VERSION":
                        $DEVICE_VERSION = $arrayCleaned[$iterator+1]['value'];
                        break;                       
                    }
                    $iterator++;
}
 
$params = "UDID=".$UDID."&CHALLENGE=".$CHALLENGE."&DEVICE_NAME=".$DEVICE_NAME."&DEVICE_PR ODUCT=".$DEVICE_PRODUCT."&DEVICE_VERSION=".$DEVICE_VERSION;

// enrollment is a directory
header('Location: enrollment?'.$params);

?>