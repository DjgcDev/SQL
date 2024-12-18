class Node:
    def __init__(self, value):
        self._value = value
        self._left = None
        self._right = None
    def get_value(self):
        return self._value
    def set_value(self, value):
        self._value = value
    def get_left(self):
        return self._left
    def set_left(self, left):
        self._left = left
    def get_right(self):
        return self._right
    def set_right(self, right):
        self._right = right
class BinaryTree:
    def __init__(self):
        self._root = None
    def get_root(self):
        return self._root
    def set_root(self, root):
        self._root = root
    def insert(self, value):
        if self._root is None:
            self._root = Node(value)
        else:
            self._insert_recursive(self._root, value)
    def _insert_recursive(self, current, value):
        if value < current.get_value():
            if current.get_left() is None:
                current.set_left(Node(value))
            else:
                self._insert_recursive(current.get_left(), value)
        else:
            if current.get_right() is None:
                current.set_right(Node(value))
            else:
                self._insert_recursive(current.get_right(), value)
    def inorder(self):
        return self._inorder_recursive(self._root)

    def _inorder_recursive(self, node):
        result = []
        if node:
            result += self._inorder_recursive(node.get_left())
            result.append(node.get_value())
            result += self._inorder_recursive(node.get_right())
        return result
    def preorder(self):
        return self._preorder_recursive(self._root)
    def _preorder_recursive(self, node):
        result = []
        if node:
            result.append(node.get_value())
            result += self._preorder_recursive(node.get_left())
            result += self._preorder_recursive(node.get_right())
        return result
    def postorder(self):
        return self._postorder_recursive(self._root)
    def _postorder_recursive(self, node):
        result = []
        if node:
            result += self._postorder_recursive(node.get_left())
            result += self._postorder_recursive(node.get_right())
            result.append(node.get_value())
        return result

if __name__ == "__main__":

    tree = BinaryTree()
    values = [10, 6, 15, 3, 8, 12, 20]
    for value in values:
        tree.insert(value)

    print("In-order Traversal:", ' '.join(map(str, tree.inorder())))
    print("Pre-order Traversal:", ' '.join(map(str, tree.preorder())))
    print("Post-order Traversal:", ' '.join(map(str, tree.postorder())))
