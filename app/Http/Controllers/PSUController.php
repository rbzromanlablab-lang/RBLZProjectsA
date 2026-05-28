<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PSUController extends Controller
{
    public function welcome()
        {
            return "Roman Benedict L. Zacarias " .date("y,m,d");
        }

    public function mission()
        {
            return "The Pangasinan State University, shall provide a human-centric, <br>
            resilient , and sustainable academic environment to produce dynamic, responsive, <br>
            and future-ready individuals capable of meeting the requirements <br>
             of the local and global communities and industries. " .date("y,m,d"); 
        }
    
    public function vision()
        {
            return "To become a leading industry-driven State University in the ASEAN region by 2030 " .date("y,m,d");
        }

    public function EOMSPolicy()
        {
            return "The Pangasinan State University shall be recognized as an ASEAN <br>
            premier state university that provides quality education and satisfactory <br>
            service delivery through instruction, research, extension and production. <br> <br>
            
            We commit our expertise and resources to produce professionals who meet the <br>
            expectations of the industry and other interested parties in the national <br> 
            and international community. <br><br>
            
            We shall continuously improve our operations through systems and process innovations <br>
            guided by ethical, intellectual property and technology transfer standards in <br> 
            response to the changing educational, scientific and technological developments <br>
             for social responsiveness and in support of the institution’s strategic direction. ".date("y,m,d");
        }

        function student($name , $course ): string {
            return "NAME: " .$name. " <br>COURSE: " . $course;
        }
}
