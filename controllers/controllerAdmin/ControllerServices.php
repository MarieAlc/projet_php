<?php
class ControllerServices extends Controller {

    public function showServicesAdmin() {
        $this->verifierAdmin();  
        $serviceManager = new ServiceManager();
        
       
        $services = $serviceManager->getListeServices();
        $message = $_SESSION['message'] ?? null;
        $errors = $_SESSION['errors'] ?? [];

        unset($_SESSION['message'], $_SESSION['errors']);
   
        $views = new Views();
        $views->render('admin/servicesadmin', [
            'services' => $services,
            'message' => $message,
            'errors' => $errors
        ]);
    }

    public function ajouterService() {
        $this->verifierAdmin();  
        $serviceManager = new ServiceManager();
        
        try {
         
            $serviceManager->ajouterService();
            $_SESSION['message'] = "Le service a été ajouté avec succès.";
        } catch (Exception $e) {
            $_SESSION['errors'][] = $e->getMessage();
        }
  
        header('Location: index.php?action=servicesadmin');
        exit;
    }

    public function modifierService() {
        $this->verifierAdmin(); 
        $serviceManager = new ServiceManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $serviceId = $_POST['id'];
            $nom = $_POST['nom'];
            $description = $_POST['description'];
            $prix = $_POST['prix'];
    
            try {
                $serviceManager->modifierService($serviceId, $nom, $description, $prix);
                $_SESSION['message'] = "Le service a été modifié avec succès.";
                header('Location: index.php?action=servicesadmin');
                exit;
            } catch (Exception $e) {
                $_SESSION['errors'][] = $e->getMessage();
                header('Location: index.php?action=modifierservice&id=' . $serviceId);
                exit;
            }
        }
    
    
        if (isset($_GET['id'])) {
            $serviceId = $_GET['id'];
            $service = $serviceManager->getService($serviceId);
            
            if ($service === null) {
                $_SESSION['errors'][] = "Le service n'existe pas.";
                header('Location: index.php?action=servicesadmin');
                exit;
            }

            $views = new Views();
            $views->render('admin/modifierservice', ['service' => $service]);
        }
    }

    public function supprimerService() {
        $this->verifierAdmin();  
        if (isset($_GET['id'])) {
            $serviceId = $_GET['id'];
            $serviceManager = new ServiceManager();
            
            try {
                
                $serviceManager->supprimerService($serviceId);
                $_SESSION['message'] = "Le service a été supprimé avec succès.";
            } catch (Exception $e) {
              
                $_SESSION['errors'][] = $e->getMessage();
            }
        }
      
        header('Location: index.php?action=servicesadmin');
        exit;
    }


}