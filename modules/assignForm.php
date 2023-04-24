<div id="formulario">
            <!--------------ADD A CASE-------------------->
            <form action="include/insertCase.php" method="post" name="addForm" style="display:none">
                <div id="addForm0">Add a new case</div><!-- addForm0 -->
                <div id="addForm1">Case #</div> <!-- addForm1 -->
                <div id="addForm2">
                    <input name="casetxt" type="text" size="10" maxlength="10" onkeypress="return onlyNumbers(event)" />
                </div><!-- addForm2 -->
                <div id="addForm3">Premier</div><!-- addForm3 -->
                 <div id="prodTitle">Product </div>
                 <div id="product"></div>
                <div id="addForm4">
                    <select id="premier" name="premier" onChange="getenglst()">
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                 </div><!-- addForm4 -->
                 <div id="assignCallback">As </div><!-- assignCallback -->
                 <div id="callbackselect">
                    <select id="ascallback" name="ascallback">
                        <option value="Normal">Normal</option>
                        <option value="Callback">Callback</option>
                        <option value="Elevation">Elevation</option>
                        
                    </select>
                </div><!-- callbackselect -->
                <div id="addForm5">Engineer</div><!-- addForm5 -->
                <div id="addForm61"></div><!-- addForm61 Engineer list -->
                <div id="addForm12">Impact</div>
                <div id="addForm13"><select id="severitylst" name="severitylst">
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                    </select>
                </div><!-- addForm13 -->
                <div id="addForm7" type="hidden" ></div><!-- addForm7 -->
                <div id="addForm8">
                    <input name="callbackchk" type="hidden" type="checkbox" value="1" />
                </div><!-- addForm8 -->
                
                <div id="addForm11" class="genericBlueButton"><a href="javascript:newCaseSubmit()">Add</a></div><!-- addForm11 -->
            </form>  
            <!--------------DELETE-------------------->
            <form action="include/deleteCase.php" method="post" name="delForm" style="display:none">
                <div id="addForm0">Delete a case</div>
                <div id="addForm1">Case #</div>
                <div id="addForm2"><input name="casetxt" type="text" size="10" maxlength="10" onkeypress="return onlyNumbers(event)"/></div>
                <div id="addFormSearch"><a href="javascript:searchCase(1)"><img src="images/search.png" width="14" height="14" alt="Search" title="Search" class="genericBlueButton"/></a> </div>
                <div id="addForm15">Search for an existing case</div>
                <div id="addForm14" onclick="history('include/caseHistory.php', document.delForm.casetxt.value);">Or check full case <a href="include/caseHistory.php" onclick="return false;">History</a></div>
                <div id="addForm11" class="genericBlueButton"><a href="javascript:deleteCase()">Delete</a></div>
            </form>    
            <!---------------MODIFY------------------->
            <form id="modForm" action="include/modifyCase.php" method="post" name="modForm" style="display:none">
                <div id="addForm0">Modify an existing case</div>
                <div id="addForm1">Case #</div>
                <div id="addForm2">
                    <input name="casetxt" type="text" size="10" maxlength="10" onkeypress="return onlyNumbers(event)" />
                </div>
                <div id="addFormSearch"><a href="javascript:searchCase(2)" ><img src="images/search.png" width="14" height="14" alt="Search" title="Search" class="genericBlueButton"/></a></div>
                <div id="addForm3">Premier</div>
                <div id="addForm4">
                    <select id="premier2" name="premier2"  onChange="getenglst2()">
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                </div>
                <div id="addForm5">Engineer</div>
                <div id="addForm62"></div>
                <div id="addForm12">Impact</div>
                <div id="addForm13">
                    <select name="severitylst">
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </div>
                <div id="addForm7"></div>
                <div id="addForm8"><input name="callbackchk" type="hidden" type="checkbox" value="" /></div>
                <div id="prodTitle">Product </div>
                 <div id="product2"></div>
                <!--<div id="addForm9">Date</div>
                <div id="addForm10"><input type="text" id="datepicker2" size="10"></div>-->
                <div id="addForm11" class="genericBlueButton"><a href="javascript:modifyCase()">Modify</a></div>
            </form>    
            <!----------------Reports------------------>
            <form action="submit" method="get" name="misForm" style="display:none">
                <div id="addForm0"><!--Submit a misrouted case-->Create Reports</div>
                <div id="addForm1">From</div>
                <div id="addForm2"><input type="text" id="datepicker3" size="10"></div>
                <div id="addForm16">To</div>
                <div id="addForm17"><input type="text" id="datepicker4" size="10"></div>
                <div id="addForm18">Report</div>
                <div id="addForm19">
                    <select id="reportType" name="reportType"  onChange="getenglst3()">
                        <option value="1">Team Average by engineer</option>
                        <option value="2">Premier Average by engineer</option>
                        <option value="3">Foundation Average by engineer</option>
                        <option value="4">All Total Cases by engineer</option>
                        <option value="5">Total Cases Premier by engineer</option>
                        <option value="6">Total Cases Foundation by engineer</option>
                        <option value="7">Cases by engineer</option>       
                        <option value="8">All Critical Cases by engineer</option>  
                        <option value="9">Foundation Critical Cases by engineer</option>   
                        <option value="10">Premier Critical Cases by engineer</option>  
                        <option value="11">Details by User</option>               
                    </select>
                </div>
                <div id="addForm3">Engineer</div>
                <div id="addForm44">  </div>
                <div id="addForm11" class="genericBlueButton"><a href="javascript:graphicAv('graphs/graphAvPeriod.php')">Create</a></div>
            </form>    
        </div><!-- formulario -->