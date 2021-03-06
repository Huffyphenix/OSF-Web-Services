<?php

/** @defgroup WsOntology Ontology Management Web Service */
//@{

/*! @file \StructuredDynamics\osf\ws\ontology\admin\analyzeRegisters.php
    @brief Analyze the OWLAPI registers that are currently processed in Tomcat via the PHP/Java bridge.
    
    You may want to restrict the access to this /admin/ folder in your Apache settings so that
    not everybody has access to it.
 */

  use \StructuredDynamics\osf\ws\framework\WebService;
      
  $osf_ini = parse_ini_file(WebService::$osf_ini . "osf.ini", TRUE);

  // Starts the GATE process/bridge
  require_once($osf_ini["owlapi"]["bridge_uri"]);

  // Attach to the screen sessions
  // Second param "false" => we re-use the pre-created session without destroying the previous one
  // third param "0" => it nevers timeout.
  $OwlApiSession = java_session("OWLAPI", false, 0);
           
  echo "<h2>Registered ontologies</h2>";
  
  if(!is_null(java_values($OwlApiSession->get("ontologiesRegister"))))
  {
    $register = $OwlApiSession->get("ontologiesRegister");

    foreach($register as $onto => $id)
    {
      $onto = str_replace("-ontology", "", $onto);

      echo "$onto<br />";
    }
  }
  else
  {
    echo "None";
  }
                    
  echo "<h2>Registered reasoners</h2>";

  if(!is_null(java_values($OwlApiSession->get("reasonersRegister"))))
  {
    $register = $OwlApiSession->get("reasonersRegister");

    foreach($register as $onto => $id)
    {
      $onto = str_replace("-reasoner", "", $onto);

      echo "$onto<br />";
    }
  }
  else
  {
    echo "None";
  }

//@}

?>