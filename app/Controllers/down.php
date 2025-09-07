 <?php
namespace App\Controllers;
use App\Models\FileModel;
class Down extends BaseController
{

 public function index()
    {
        include('conn.php');
        
        $sql1 ="select * from files where id=0";
        $result1 = mysqli_query($conn, $sql1);
        $files = mysqli_fetch_assoc($result1);
         foreach ($files as $file) {
        $namemm = $file['name'];
        $updateData = [
            'version' => $file['version'],
            'downloadUrl' => ['http://nonomod.freewebhostmost.com/update/'.$file['name']],
            'libname' => $file['name'],
            'releaseNotes' => 'Bug fixes and performance improvements',
        ];

        return $this->respond($updateData);
         }
    }

}
