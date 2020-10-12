<?php
    // Remove unnecessary words from the search term and return them as an array
    function filterSearchKeys($query){
        $query = trim(preg_replace("/(\s+)+/", " ", $query));
        $words = array();
        // expand this list with your words.
        $list = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
                    "A", "B", "C", "D", "E", "F", "G", "H", "I", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", );
        $c = 0;
        foreach(explode(" ", $query) as $key){
            if (in_array($key, $list)){
                continue;
            }
            $words[] = $key;
            if ($c >= 15){
                break;
            }
            $c++;
        }
        return $words;
    }

    // limit words number of characters
    function limitChars($query, $limit = 200){
        return substr($query, 0,$limit);
    }

    function search($query){

        $query = trim($query);
        if (mb_strlen($query)===0){
            // no need for empty search right?
            return false; 
        }
        $query = limitChars($query);

        // Weighing scores
        $scoreName = 3;
        $scoreImage = 2;
        $scoreDetail = 1;

        $keywords = filterSearchKeys($query);
        $nameSQL = array();
        $imageSQL = array();
        $detailSQL = array();

        /** Matching full occurences **/
        if (count($keywords) > 1){
            $nameSQL[] = "if (prd_name LIKE '%". $query."%',".$scoreName*count($keywords).",0)";
            $imageSQL[] = "if (prd_image LIKE '%". $query."%',".$scoreImage*count($keywords).",0)";
            $detailSQL[] = "if (prd_details LIKE '%". $query."%',".$scoreDetail*count($keywords).",0)";
        }

        /** Matching Keywords **/
        foreach($keywords as $key){
            $nameSQL[] = "if (prd_name LIKE '%".$key."%',{$scoreName},0)";
            $imageSQL[] = "if (prd_image LIKE '%".$key."%',{$scoreName},0)";
            $detailSQL[] = "if (prd_details LIKE '%".$key."%',{$scoreDetail},0)";
        }

        // Just incase it's empty, add 0
        if (empty($nameSQL)){
            $nameSQL[] = 0;
        }
        if (empty($detailSQL)){
            $detailSQL[] = 0;
        }
        if (empty($imageSQL)){
            $imageSQL[] = 0;
        }

        $sql = "SELECT prd_id, prd_name,
                (
                    (
                    ".implode(" + ", $nameSQL)."
                    )+
                    (
                    ".implode(" + ", $imageSQL)." 
                    )+
                    (
                    ".implode(" + ", $detailSQL)." 
                    )
                ) as relevance
                FROM product
                WHERE prd_status = 1
                HAVING relevance > 0
                ORDER BY relevance DESC
                LIMIT 5";
        return $sql;
    }

    function searchFull($query, $offset=0, $limit=1073741824){

        $query = trim($query);
        if (mb_strlen($query)===0){
            // no need for empty search right?
            return false; 
        }
        $query = limitChars($query);

        // Weighing scores
        $scoreName = 3;
        $scoreImage = 2;
        $scoreDetail = 1;

        foreach(explode(" ", $query) as $key){
            $keywords[] = $key;
        }
        $nameSQL = array();
        $imageSQL = array();
        $detailSQL = array();

        /** Matching full occurences **/
        if (count($keywords) > 1){
            $nameSQL[] = "if (prd_name LIKE '%". $query."%',".$scoreName*count($keywords).",0)";
            $imageSQL[] = "if (prd_image LIKE '%". $query."%',".$scoreImage*count($keywords).",0)";
            $detailSQL[] = "if (prd_details LIKE '%". $query."%',".$scoreDetail*count($keywords).",0)";
        }

        /** Matching Keywords **/
        foreach($keywords as $key){
            $nameSQL[] = "if (prd_name LIKE '%".$key."%',{$scoreName},0)";
            $imageSQL[] = "if (prd_image LIKE '%".$key."%',{$scoreName},0)";
            $detailSQL[] = "if (prd_details LIKE '%".$key."%',{$scoreDetail},0)";
        }

        // Just incase it's empty, add 0
        if (empty($nameSQL)){
            $nameSQL[] = 0;
        }
        if (empty($detailSQL)){
            $detailSQL[] = 0;
        }
        if (empty($imageSQL)){
            $imageSQL[] = 0;
        }

        $sql = "SELECT *,
                (
                    (
                    ".implode(" + ", $nameSQL)."
                    )+
                    (
                    ".implode(" + ", $imageSQL)." 
                    )+
                    (
                    ".implode(" + ", $detailSQL)." 
                    )
                ) as relevance
                FROM product
                WHERE prd_status = 1
                HAVING relevance > 0
                ORDER BY relevance DESC
                LIMIT ".$offset.", ".$limit;
        return $sql;
    }
?>