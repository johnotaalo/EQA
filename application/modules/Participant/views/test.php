
            <tr>
                <th style="width: 30%;">Sample Tubes</th>
                <td>
                    <?php
                        if($tracking->sample_tubes == 0){
                            echo "Broken";
                        }else if($tracking->sample_tubes == 1){
                            echo "Leaking";
                        }else if($tracking->sample_tubes == 2){
                            echo "Cracked";
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <th style="width: 30%;">Insufficient Volume</th>
                <td>
                    <?php
                        if($tracking->insufficient_volume == 1){
                            echo "Yes";
                        }else if($tracking->insufficient_volume == 0){
                            echo "No";
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <th style="width: 30%;">Haemolysed sample</th>
                <td>
                    <?php
                        if($tracking->haemolysed_sample == 1){
                            echo "Yes";
                        }else if($tracking->haemolysed_sample == 0){
                            echo "No";
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <th style="width: 30%;">Clotted sample</th>
                <td>
                    <?php
                        if($tracking->clotted_sample == 1){
                            echo "Yes";
                        }else if($tracking->clotted_sample == 0){
                            echo "No";
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <th style="width: 30%;">Duplicate sample received</th>
                <td>
                    <?php
                        if($tracking->duplicate_sample == 1){
                            echo "Yes";
                        }else if($tracking->duplicate_sample == 0){
                            echo "No";
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <th style="width: 30%;">Missing sample</th>
                <td>
                    <?php
                        if($tracking->missing_sample == 1){
                            echo "Yes";
                        }else if($tracking->missing_sample == 0){
                            echo "No";
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <th style="width: 30%;">Mismatch of information details on introductory letter and sample tube</th>
                <td>
                    <?php
                        if($tracking->mismatch == 1){
                            echo "Yes";
                        }else if($tracking->mismatch == 0){
                            echo "No";
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <th style="width: 30%;">Participant Comment</th>
                <td>
                    <?= @$tracking->panel_condition_comment; ?>
                </td>
            </tr>