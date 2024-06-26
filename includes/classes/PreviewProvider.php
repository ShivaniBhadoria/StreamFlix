<?php
class PreviewProvider {

    private $con, $username;


    public function __construct($con, $username) {
        $this->con = $con;
        $this->username = $username;
    }

    public function createPreviewVideo($entity) {
        
        if($entity == null){
            $entity = $this->getRandomEntity();
        }

        $id = $entity->getId();
        $name = $entity->getName();
        $preview = $entity->getPreview();
        $thumbnail = $entity->getThumbnail();
        $overview = $entity->getOverview();

        if (empty($overview)) {
            $overview = "No overview available.";
        }

        //Todo: Add subtitle

        return "<div class='preview-container'>

                    <img src='$thumbnail' class='preview-image' hidden>

                    <video autoplay muted class='preview-video' onended='previewEnded()'>
                        <source src='$preview' type='video/mp4'>
                    </video>
                    
                    <div class='preview-overlay'>
                        <div class='preview-details'>
                            <h3>$name</h3>
                            <div class='preview-actions'>
                                <button class='play-btn btn'>
                                    <i class='fa-solid fa-play'></i>
                                    <span>Watch</span>
                                </button>
                                <button class='info-btn btn' onclick='openModal()'>
                                    <i class='fa-solid fa-circle-info'></i>
                                    <span>More info</span>
                                </button>
                                <div class='vol-container'>
                                    <button onclick='soundToggle(this)' id='sound-btn' data-previous-class='fa-volume-xmark'>
                                        <i class='fa-solid fa-volume-xmark'></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id='infoModal' class='modal'>
                    <div class='modal-content'>
                        <i onclick='closeModal()' class='fa-regular fa-circle-xmark close'></i>
                        <h2>$name</h2>
                        <img src='$thumbnail' class='modal-image'>
                        <p>$overview</p>
                    </div>
                </div>";

    }

    public function createEntityPreviewFrame($entity) {
        $id = $entity->getId();
        $thumbnail = $entity->getThumbnail();
        $name = $entity->getName();

        return "<a href='entity.php?id=$id'>
                    <div class='preview-container small'>
                        <img src='$thumbnail' title='$name'>
                    </div>
                </a>";
    }

    private function getRandomEntity() {

        $entity = EntityProvider::getEntities($this->con, null, 1);
        return $entity[0];
    }
}
?>