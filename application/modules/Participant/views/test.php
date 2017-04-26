$equipment_tabs .= "<div class='modal fade ' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                          <div class='modal-dialog' role='document'>
                            <div class='modal-content'>

                              <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                <h4 class='modal-title' id='myModalLabel'>Provide your verdict for this result</h4>
                              </div>


                            <div class='modal-body'>
                            <form method='POST' id='reply'>
                              <div class='form-group'> <label>Verdict</label>
                                  <select name='gender' id='gender' class='form-control' required>
                                    <option value='Select your verdict'></option>
                                    <option value='Accepted'>Accepted</option>
                                    <option value='Rejected'>Rejected</option>
                                </select>
                              </div>


                              <div class='form-group'>
                                <label>Comments</label>
                                <textarea maxvalue='500' name='comments' class='form-control' rows='3'></textarea>
                              </div>
                            </form>
                            </div>

                            <div class='modal-footer'>
                                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                <input type='submit' id='survey-submi' value='Submit' class='btn btn-primary'>
                            </div>

                            </div>
                          </div>
                        </div>
                        ";