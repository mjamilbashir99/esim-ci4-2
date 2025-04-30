<style>

  </style>

<div class="table-container-tmg">
  <div class="header-tmg">
    <h3>Markups</h3>
    <a href="" data-toggle="modal" data-target="#addModal"><button>+ Add</button></a>
  </div>

  <table class="table-tmg">
    <thead>
      <tr>
        <th>#</th>
        <th>STATUS</th>
        <th>B2C MARKUP</th>
        <th>B2B MARKUP</th>
        <th>LOCATION</th>
        <th>FROM DATE</th>
        <th>TO DATE</th>
        <th>MODULE ID</th>
        <th>ACTIONS</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>
          <label class="switch-tmg">
            <input type="checkbox" checked>
            <span class="slider-tmg"></span>
          </label>
        </td>
        <td>10 %</td>
        <td>5 %</td>
        <td>Dubai</td>
        <td>-</td>
        <td>-</td>
        <td>hotelbeds</td>
        <td class="actions-tmg">
          <button>Edit</button>
          <button>Delete</button>
        </td>
      </tr>
    </tbody>
  </table>

  <div class="footer">
    <div></div>
    <div class="pagination">
      <button class="active">25</button>
      <button>50</button>
      <button>100</button>
      <button>All</button>
    </div>
  </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="markupModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="markupModalLabel">Markup Settings</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="markupForm">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="enabled">Enabled</option>
                            <option value="disabled">Disabled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="b2cMarkup">Module</label>
                        <input type="number" class="form-control" id="b2cMarkup" name="b2cMarkup" value="10" step="0.01" min="0">
                    </div>
                    <div class="form-group">
                    <label for="status">Module Id</label>
                    <select class="form-control" id="status" name="status">
                        <option value="" selected disabled>Hotel</option>
                        <option value="enabled">Enabled</option>
                        <option value="disabled">Disabled</option>
                    </select>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Return</button>
                <button class="btn btn-primary" type="button" id="saveMarkup">Save</button>
            </div>
        </div>
    </div>
</div>