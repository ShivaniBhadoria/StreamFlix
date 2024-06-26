<?php

class SeasonProvider {

    private $con, $username;

    public function __construct($con, $username) {
        $this->con = $con;
        $this->username = $username;
    }

    public function create($entity) {
        $seasons = $entity->getSeasons();
 
        if(sizeof($seasons) == 0) {
            return;
        }

        $seasonsHtml = "";
        foreach($seasons as $season) {
            $seasonNumber = $season->getSeasonNumber();
            $videosHtml = "";
            
            foreach($season->getVideos() as $video) {
                $videosHtml .= $this->createVideoFrame($video);
            }

            $seasonsHtml .= "<div class='season'>
                                <h3>Season $seasonNumber</h3>
                                <div class='videos'>
                                    $videosHtml
                                </div>
                            </div>";
        }

        return $seasonsHtml;
    }

    private function createVideoFrame($video) {
        $id = $video->getId();
        $thumbnail = $video->getThumbnail();
        $name = $video->getTitle();
        $description = $video->getDescription();
        $episodeNumber = $video->getEpisodeNumber();

        return "<a href='watch.php?id=$id'>
                    <div class='episode-container'>
                        <div class='contents'>

                            <img src='$thumbnail'>

                            <div class='video-info'>
                                <h4>$episodeNumber. $name</h4>
                                <span>$description</span>
                            </div>

                        </div>
                    </div>
                </a>";
    }

}
?>