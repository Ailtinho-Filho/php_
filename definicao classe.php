<?php
class User {
    private $data = [];
    private $nextId = 1;

    public function __construct() {
        // Load existing data if needed
        $this->loadData();
    }

    private function loadData() {
        if (file_exists('data.json')) {
            $this->data = json_decode(file_get_contents('data.json'), true);
            $this->nextId = empty($this->data) ? 1 : max(array_column($this->data, 'id')) + 1;
        }
    }

    private function saveData() {
        file_put_contents('data.json', json_encode($this->data, JSON_PRETTY_PRINT));
    }

    public function create($name, $email) {
        $this->data[] = [
            'id' => $this->nextId++,
            'name' => $name,
            'email' => $email
        ];
        $this->saveData();
    }

    public function read() {
        return $this->data;
    }

    public function update($id, $name, $email) {
        foreach ($this->data as &$user) {
            if ($user['id'] == $id) {
                $user['name'] = $name;
                $user['email'] = $email;
                $this->saveData();
                return true;
            }
        }
        return false;
    }

    public function delete($id) {
        foreach ($this->data as $key => $user) {
            if ($user['id'] == $id) {
                unset($this->data[$key]);
                $this->data = array_values($this->data); // Re-index the array
                $this->saveData();
                return true;
            }
        }
        return false;
    }
}
?>
